<?php

namespace app\helpers;

/**
 * Class Strings
 * @package app\helpers
 */
class Strings
{
    /**
     * @param string $string
     * @return string
     */
    public static function camelize(string $string): string
    {
        return str_replace(['-', '_'], '', ucwords($string, '-_'));
    }
}