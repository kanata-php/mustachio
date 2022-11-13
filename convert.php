<?php

require __DIR__ . '/vendor/autoload.php';

use Mustachio\Commands\ProcessCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$command = new ProcessCommand;
$application->add($command);
// no need to have the compile command available elsewhere
$application->setDefaultCommand($command->getName(), true);

$application->run();