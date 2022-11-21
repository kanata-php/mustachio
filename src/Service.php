<?php

namespace Mustachio;

use InvalidArgumentException;
use Mustache_Engine;

class Service
{
    const MUSTACHE = 'mustache';

    /**
     * Parse stub with parameters
     *
     * @param string $content
     * @param array $params
     * @param string $engine
     * @return string
     * @throws InvalidArgumentException
     */
    public static function parse(
        string $content,
        array $params,
        string $engine = self::MUSTACHE
    ): string {
        if (self::MUSTACHE === $engine) {
            $m = new Mustache_Engine(['entity_flags' => ENT_QUOTES]);
            return $m->render($content, $params);
        }

        throw new InvalidArgumentException('Invalid engine!');
    }

    /**
     * Replace File Lines that match the callback condition.
     * 
     * This method replace lines at the callables by the string with the same keys.
     *
     * @param string $file
     * @param array $conditions (callable[]) Args: string $lineValue
     * @param array $values (string[])
     * @param ?callable $toRemove Callback that returns boolean for wether to remote or not the line.
     * @return void
     */
    public static function replaceFileLineByCondition(
        string $file,
        array $conditions,
        array $values,
        ?callable $toRemove = null,
    ) {
        $tempFile = $file . '.tmp';

        $reading = fopen($file, 'r');
        $writing = fopen($tempFile, 'w');

        while (!feof($reading)) {
            $line = fgets($reading);

            if (null !== $toRemove && $toRemove($line)) {
                continue;
            }

            $written = false;
            foreach ($conditions as $key => $condition) {
                if ($condition($line)) {
                    $newLine =  $values[$key] . PHP_EOL;
                    $written = true;
                }
            }

            if (!$written) {
                $newLine = $line;
            }

            fputs($writing, $newLine);
        }
        
        fclose($reading);
        fclose($writing);

        unlink($file);
        rename($tempFile, $file);
    }
}
