<?php

require __DIR__ . '/vendor/autoload.php';

use Mustachio\Commands\CompileCommand;
use Mustachio\Commands\ProcessCommand;
use Symfony\Component\Console\Application;

const ROOT_DIR = __DIR__;

$application = new Application();

$application->add(new ProcessCommand);
$application->add(new CompileCommand);

$application->run();