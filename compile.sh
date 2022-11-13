#!/bin/bash

# Prepare the phar binary for this package.

/usr/bin/php convert-dev.php compile $(pwd)/bin/stashe.phar
/usr/bin/mv $(pwd)/bin/stashe.phar $(pwd)/bin/stashe