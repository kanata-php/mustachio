
<p align="center">
<img src="./imgs/mustachio.svg" height="200"/>
</p>

# Command to process template

This lib parse some template or stub. You can use it as a PHP [terminal command](#cli-phar-usage) or in your [code](#code-usage).

Kudos to [Mustache](https://github.com/bobthecow/mustache.php)!

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
php bin/stashe "/path/to/my.stub" "/path/to/my.php" "PLACEHOLDER:value;PLACEHOLDER2:value2"
```
## Tests

```shell
vendor/bin/pest
```
