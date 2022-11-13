<?php

use Mustachio\Commands\ProcessCommand;
use Mustachio\Service;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @covers \Mustachio\Commands\ProcessCommand
 */
test('can parse sample stub via cli', function () {
    $application = new Application;
    $application->add(new ProcessCommand);
    $command = $application->find('process');
    $tester = new CommandTester($command);
    $destination = __DIR__ . '/temp/sample.txt';
    $tester->execute([
        'template' => __DIR__ . '/stubs/sample.stub',
        'destination' => $destination,
        'params' => 'PLACEHOLDER:nada',
    ]);
    expect(file_exists($destination))->toBeTrue();
    expect(strstr(file_get_contents($destination), 'nada') !== false)->toBeTrue();
    expect(strstr(file_get_contents($destination), 'PLACEHOLDER') === false)->toBeTrue();
    unlink($destination);
});

/**
 * @covers \Mustachio\Commands\ProcessCommand
 */
test('cant parse sample stub via cli without required parameters', function () {
    $application = new Application;
    $application->add(new ProcessCommand);
    $command = $application->find('process');
    $tester = new CommandTester($command);
    $destination = __DIR__ . '/temp/sample.txt';

    expect(fn() => $tester->execute([
        'destination' => $destination,
        'params' => 'PLACEHOLDER:nada',
    ]))->toThrow(Exception::class);
    
    expect(fn() => $tester->execute([
        'template' => __DIR__ . '/stubs/sample.stub',
        'params' => 'PLACEHOLDER:nada',
    ]))->toThrow(Exception::class);

    expect(fn() => $tester->execute([
        'template' => __DIR__ . '/stubs/sample.stub',
        'destination' => $destination,
    ]))->toThrow(Exception::class);
});

/**
 * @covers \Mustachio\Commands\ProcessCommand
 */
test('cant parse sample stub via cli without valid template', function () {
    $application = new Application;
    $application->add(new ProcessCommand);
    $command = $application->find('process');
    $tester = new CommandTester($command);
    $destination = __DIR__ . '/temp/sample.txt';

    expect(fn() => $tester->execute([
        'template' => __DIR__ . '/stubs/non-existent-stub',
        'destination' => $destination,
        'params' => 'PLACEHOLDER:nada',
    ]))->toThrow(Exception::class);
});

/**
 * @covers \Mustachio\Service
 */
test('can parse sample value via service', function () {
    $originalContent = file_get_contents(__DIR__ . '/stubs/sample.stub');
    $parsedContent = Service::parse($originalContent, ['PLACEHOLDER' => 'nada']);
    expect(strstr($parsedContent, 'nada') !== false)->toBeTrue();
    expect(strstr($parsedContent, 'PLACEHOLDER') === false)->toBeTrue();
});

/**
 * @covers \Mustachio\Service
 */
test('cant parse sample value via service with invalid engine', function () {
    $originalContent = file_get_contents(__DIR__ . '/stubs/sample.stub');
    expect(fn() => Service::parse($originalContent, ['PLACEHOLDER' => 'nada'], 'invalid-engine'))
        ->toThrow(InvalidArgumentException::class);
});
