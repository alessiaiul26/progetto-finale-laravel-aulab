import json
from pprint import pprint
import os
import re

if __name__ == '__main__':

    original_language = 'Italian'
    translated_languages = [
        {
            'lang': 'English', 
            'short': 'en'
        },
        {
            'lang': 'Spanish', 
            'short': 'es'
        },
        {
            'lang': 'Italian', 
            'short': 'it'
        }
    ]
    
    idx_file_path = './scripts/index.json'

    with open(idx_file_path, 'r', encoding='utf-8') as file:
        data = json.load(file)

    """
    structure of data:
    [
        "context": [
            {
                "original_language": "Italian",
                "target_languages": ["English", "Spanish"],
                "original": "original text",
                "translations": [
                    {
                        "language": "English",
                        "text": "translated text"
                    },
                    {
                        "language": "Spanish",
                        "text": "translated text"
                    }
                ],
                "summary": "summary"
            }
        ]
    ]
    """
    # get every context
    contexts = list(data.keys())
    for context in contexts:

        for translated_language in translated_languages:
            translated_language_path = f'./lang/{translated_language["short"]}/{context.replace(".", "--")}.php'

            php_translated_file_str = "<?php\n\nreturn [\n"

            for item in data[context]:
                translation = next((t['text'] for t in item['translations'] if t['language'] == translated_language['lang']), item['original'])

                if translated_language['lang'] == original_language:
                    translation = item['original']

                summary = item['summary']

                translation = translation.replace("'", "\\'").replace("\\n", "")
                php_translated_file_str += f"\t'{summary}' => '{translation}',\n"


            php_translated_file_str += "\n];"

            # make sure to create all directories if they don't exist
            os.makedirs(os.path.dirname(translated_language_path), exist_ok=True)

            with open(translated_language_path, 'w', encoding='utf-8') as f:
                f.write(php_translated_file_str)


    for context in contexts:
        blade_php_path = f'./resources/views/{context.replace(".", "/")}.blade.php'
        
        with open(blade_php_path, 'r', encoding='utf-8') as blade_file:
            blade_content = blade_file.read()

        for item in data[context]:
            original = item['original'].replace("'", "\\'").replace('\n', '')
            summary = item['summary'].replace("'", "\\'").replace('\n', '')

            if item['summary'] == None:
                item['summary'] = item['original']


            # search the translation in the blade file and replace with the summary

            blacklist = [
                '_NOSTR_',
                'NOSTR_',
                '_NOSTR',
                ':NOSTR',
                'NOSTR:',
                'NOSTR',
                '-- }}',
                '--}}',
                '{{',
                '}}',
            ]
            
            if any([x in original for x in blacklist]):
                continue
            
            if any([x in summary for x in blacklist]):
                continue
            
            php_func_str = '{{ ' + f"__('{context.replace('.', '--')}.{summary}')" + ' }}'

            regex1 = f'>\s*{original}\s*<'
            regex2 = f'>\s*{original}\s*\n'
            regex3 = re.escape(original) + r'\s*<'
            regex4 = re.escape(original) + r'\n'
            
            blade_content = re.sub(regex1, f'>{php_func_str}<', blade_content)
            blade_content = re.sub(regex2, f'>{php_func_str}\n', blade_content)
            blade_content = re.sub(regex3, f'{php_func_str}<', blade_content)
            blade_content = re.sub(regex4, f'{php_func_str}\n', blade_content)

        with open(blade_php_path, 'w', encoding='utf-8') as blade_file:
            blade_file.write(blade_content)