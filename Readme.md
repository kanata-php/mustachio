
<p align="center">
<img src="./imgs/mustachio.svg" height="200"/>
</p>

[![Tests](https://github.com/kanata-php/mustachio/actions/workflows/php.yml/badge.svg)](https://github.com/kanata-php/mustachio/actions/workflows/php.yml)

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

### Code Usage

This can serve as a file stub parser or a very simple template engine. By default, it uses [mustache](https://github.com/bobthecow/mustache.php) to parse the input file.

```php
use Mustachio\Service;
$parsedContent = Service::parse('my content with {{PLACEHOLDER}}', ['PLACEHOLDER' => 'value']);
// output: my content with value
```

### Cli Phar Usage

This can process input files giving back the output file parsed with the given placeholders.

```shell
php bin/stache "/path/to/my.stub" "/path/to/my.php" "PLACEHOLDER:value;PLACEHOLDER2:value2"
```

## Tests

```shell
vendor/bin/pest
```
