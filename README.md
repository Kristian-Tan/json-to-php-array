# json-to-php-array

## About

Tool to convert JSON into php array declaration

## Example

- I have json string below,
```json
{
    "glossary": {
        "title": "example glossary",
        "GlossDiv": {
            "title": "S",
            "GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
                    "SortAs": "SGML",
                    "GlossTerm": "Standard Generalized Markup Language",
                    "Acronym": "SGML",
                    "Abbrev": "ISO 8879:1986",
                    "GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
                        "GlossSeeAlso": ["GML", "XML"]
                    },
                    "GlossSee": "markup"
                }
            }
        }
    }
}
```
- I want to put it in php, but don't want solution like this because it's not really pretty (and my php text editor/IDE does not highlight json string): 
```php
$json = '{
    "glossary": {
        "title": "example glossary",
        "GlossDiv": {
            "title": "S",
            "GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
                    "SortAs": "SGML",
                    "GlossTerm": "Standard Generalized Markup Language",
                    "Acronym": "SGML",
                    "Abbrev": "ISO 8879:1986",
                    "GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
                        "GlossSeeAlso": ["GML", "XML"]
                    },
                    "GlossSee": "markup"
                }
            }
        }
    }
}';
$myDict = json_decode($json, true);
```
- I want solution like this instead:
```php
$myDict = [
    "glossary" => [
        "title" => "example glossary",
        "GlossDiv" => [
            "title" => "S",
            "GlossList" => [
                "GlossEntry" => [
                    "ID" => "SGML",
                    "SortAs" => "SGML",
                    "GlossTerm" => "Standard Generalized Markup Language",
                    "Acronym" => "SGML",
                    "Abbrev" => "ISO 8879:1986",
                    "GlossDef" => [
                        "para" => "A meta-markup language, used to create markup languages such as DocBook.",
                        "GlossSeeAlso" => [
                            "GML",
                            "XML",
                        ],
                    ],
                    "GlossSee" => "markup",
                ],
            ],
        ],
    ],
];
```

## Solutions

- alternative 1: just replace ":" to "=>" and "{" to "[" and "}" to "]"
- alternative 2: write a php script to do json_parse and generate php style array declaration

## Usage

- minimal: ```php json-to-php-parse.php -j'{"key":"value"}'```
- full options: ```php json-to-php-parse.php -i'  ' -l2 -j'{"key":"value"}'```
  - j = json (required)
  - i = indent (default to 4 spaces if not specified)
  - l = level of indentation

