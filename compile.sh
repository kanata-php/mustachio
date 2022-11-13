#!/bin/bash

# Prepare the phar binary for this package.

/usr/bin/php convert-dev.php compile $(pwd)/bin/stache.phar
/usr/bin/mv $(pwd)/bin/stache.phar $(pwd)/bin/stache
