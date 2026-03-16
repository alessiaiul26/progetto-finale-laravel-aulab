import json


idx_file_path = './scripts/index.json'

with open(idx_file_path, 'r', encoding='utf-8') as f:
    data = json.load(f)

contexts = list(data.keys())
for context in contexts:
    i = 0
    for item in data[context]:
        item['summary'] = str(i)
        i += 1

with open(idx_file_path, 'w', encoding='utf-8') as f:
    json.dump(data, f, indent=2, ensure_ascii=False)