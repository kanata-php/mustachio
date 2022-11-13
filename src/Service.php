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
}
