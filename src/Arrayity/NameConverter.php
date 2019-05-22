<?php

namespace Arrayity;


/**
 * Class NameConverter
 * @package Arrayity
 */
class NameConverter
{
    /**
     * @param string $input
     * @return string
     */
    public function convertToSnakeCase(string $input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * @param string $string
     * @return string
     */
    public function convertToCamelCase(string $string): string
    {
        return preg_replace_callback('/-(.?)/', function($matches) {
            return ucfirst($matches[1]);
        }, $string);
    }
}
