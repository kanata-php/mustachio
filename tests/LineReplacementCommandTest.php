<?php

use Mustachio\Service;

/**
 * @covers \Mustachio\Service
 */
test('can replace lines', function () {
    $fileBase = __DIR__ . DIRECTORY_SEPARATOR .
        'stubs' . DIRECTORY_SEPARATOR .
        'line-replacement.stub';
    $file = __DIR__ . DIRECTORY_SEPARATOR .
        'stubs' . DIRECTORY_SEPARATOR .
        'line-replacement';
    copy($fileBase, $file);

    Service::replaceFileLineByCondition(
        file: $file,
        conditions: [ fn($l) => strpos($l, 'autor aqui') !== false ],
        values: [ 'Vergilio Ferreira in Nitido Nulo' ],
        toRemove: fn ($l) => strpos($l, 'to be removed') !== false,
    );

    $finalValue = file_get_contents($file);

    expect(strpos($finalValue, 'autor aqui'))->toBeFalse();
    expect(strpos($finalValue, 'to be removed'))->toBeFalse();
    expect(strpos($finalValue, 'Vergilio Ferreira in Nitido Nulo') !== false)->toBeTrue();
    unlink($file);
});
