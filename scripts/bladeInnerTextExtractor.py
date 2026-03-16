from bs4 import BeautifulSoup
import requests
import json
import os
from pprint import pprint 
import colorama

print('started')

API_KEY = None
# parse .env file to get the API key, it contains other data as well
with open('./.env', 'r') as file:
    lines = file.readlines()
    for line in lines:
        if line.startswith('OPENAI_API_KEY'):
            API_KEY = line.split('="')[1].strip().strip('"')
            break

def translate_text(text, starting_language, target_language):
    # use open ai API to translate text
    prompt = f"""Translate the following text from {starting_language} to professional, natural {target_language} for e-commerce use. Please adhere to the following guidelines:

1. Do not translate URLs, links, proper nouns, or product names. These should remain in their original form.
2. Preserve technical terms unless a widely accepted standard translation exists.
3. Adapt informal or culturally specific expressions to a professional tone suitable for an e-commerce context.
4. If the text is untranslatable in any way, or if it is a proper noun, link, or other non-translatable content, return ":NOSTR:".
5. After translating the text, add a summary of the original text in {starting_language} after a separator line "#####". The summary should be no more than 10 words and should use underscores instead of spaces. If the summary is 5 words or fewer, repeat the translation.

Remember, the summary must be in {starting_language}, and the translation itself must be in {target_language}.
"""

    headers = {
        'Authorization': f'Bearer {API_KEY}',
        'Content-Type': 'application/json'
    }

    obj = {
        'model': "gpt-4o",
        'messages': [
            {"role": "system", "content": prompt},
            {
                "role": "user",
                "content": text
            }
        ]
    }

    completion = requests.post('https://api.openai.com/v1/chat/completions', json=obj, headers=headers).json()

    try:
        return completion["choices"][0]["message"]['content']
    except (KeyError, IndexError):
        return ":NOSTR:"


def extract_inner_text(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        content = file.read()
    
    soup = BeautifulSoup(content, 'html.parser')
    text = soup.get_text()
    
    isPHPBlock = False
    result = []
    for line in text.splitlines():
        text = line.strip()

        if text.startswith("@php"):
            isPHPBlock = True
            continue

        if text.startswith("@endphp"):
            isPHPBlock = False
            continue

        if isPHPBlock:
            continue

        if not text or text.startswith("@") or text.startswith("{"):  # Only print non-empty lines
            continue
        
        result.append(text)

    # remove duplicates
    result = list(dict.fromkeys(result))

    return result

if __name__ == '__main__':

    # scan for all contexts, being files that end with .blade.php

    contexts = []
    # scan for all files in the resources/views directory

    for root, dirs, files in os.walk('./resources/views'):
        for file in files:
            # if name is homepage and it's in a folder the context must be foldername.filename 
            if file.endswith('.blade.php'):
                context = file.replace('.blade.php', '')
                if root != './resources/views':
                    context = f'{root[len("./resources/views/"):]}.{context}'
                contexts.append(context)


    translations = {}
    with open('./scripts/index.json', 'r', encoding='utf-8') as f:
        translations = json.load(f)

    for context in contexts:
        if context not in translations:
            translations[context] = []

    # Example usage
    for context in contexts:
        texts = extract_inner_text(f'resources\\views\\{context.replace(".", "/")}.blade.php')

        target_languages = ['English', 'Spanish']

        print('*'*50)
        print(f'Current context: {context} - to languages: {target_languages}\n')

        i = 0
        for text in texts:
            translated_texts = []
            print(colorama.Fore.YELLOW + f'Translating: ' + colorama.Fore.RESET + f'{text}', end='')

            if any(translations[contexts[0]]) and any([t['original'] == text for t in translations[contexts[0]]]):
                print(colorama.Fore.GREEN + ' - Done' + colorama.Fore.RESET)
                continue

            for target_language in target_languages:
                ai_output = translate_text(text, 'Italian', target_language)

                # Example output
                # :NOSTR:           # translation
                # #####             # separator
                # presto.it         # summary
                if ":NO" in ai_output:
                    continue

                translated_text = ai_output.split("#####")[0].strip()
                split_output = ai_output.split("#####")
                if len(split_output) > 1:
                    summary = split_output[1].strip() 
                else:
                    continue
                
                
                if translated_text.startswith(":NO"):
                    continue

                translated_texts.append({"language": target_language, "text": translated_text})

            translations[context].append({
                'original_language': 'Italian',
                'target_languages': target_languages,
                'original': text, 
                'translations': translated_texts, 
                'summary': summary
            })

            i += 1

            print(colorama.Fore.GREEN + ' - Done' + colorama.Fore.RESET)

            with open('./scripts/index.json', 'w', encoding='utf-8') as f:
                json.dump(translations, f, ensure_ascii=False, indent=2)


