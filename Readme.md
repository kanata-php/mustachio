
<p align="center">
<img src="./imgs/mustachio.svg" height="200"/>
</p>

<p align="left">
<a href="https://github.com/kanata-php/mustachio/actions/workflows/php.yml" alt="Tests"><img src="https://github.com/kanata-php/mustachio/actions/workflows/php.yml/badge.svg" alt="Tests"></a>
<a href="https://codecov.io/gh/kanata-php/mustachio" alt="Code Coverage"> 
 <img src="https://codecov.io/gh/kanata-php/mustachio/branch/master/graph/badge.svg?token=T90GYFRWPZ"/> 
 </a>
</p>

# Mustachio

This lib parse some template or stub. You can use it as a PHP [terminal command](#cli-phar-usage) or in your [code](#code-usage).

Kudos to [Mustache](https://github.com/bobthecow/mustache.php)!

## Install

### CLI

To use as a CLI command, you can download the phar file:

> **Important:** remember to replace the `version-number`!

- https://github.com/kanata-php/mustachio/releases/download/{version-number}/stache .

### Library

Install via composer:

```shell
composer require kanata-php/mustachio
```

## Usage

### App Service

#### Stub Parser

This can serve as a file stub parser or a very simple template engine. By default, it uses [mustache](https://github.com/bobthecow/mustache.php) to parse the input file.

```php
use Mustachio\Service as Stache;
$parsedContent = Stache::parse('my content with {{PLACEHOLDER}}', ['PLACEHOLDER' => 'value']);
// output: my content with value
```

#### Line Replacement

This can be used to replace/remove lines in files.

```php
use Mustachio\Service as Stache;
Stache::replaceFileLineByCondition(
    file: '/path/to/file',
    conditions: [
        fn($l) => strpos($l, 'identifier-1') !== false,
        fn($l) => strpos($l, 'identifier-2') !== false,
    ],
    values: [
        'replacement-for-identifier-1',
        'replacement-for-identifier-2',
    ],
    toRemove: function ($l) {
        return strpos($l, 'identifier-to-remove') !== false;
    },
);
// output: update the original file
```

### Cli Phar Usage

#### Stub Parser

This can process input files giving back the output file parsed with the given placeholders.

```shell
php bin/stache "/path/to/my.stub" "/path/to/my.php" "PLACEHOLDER:value;PLACEHOLDER2:value2"
```

## Tests

```shell
vendor/bin/pest
```
