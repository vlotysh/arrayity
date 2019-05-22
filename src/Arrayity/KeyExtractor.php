<?php


namespace Arrayity;


/**
 * Class KeyExtractor
 *
 * @package Arrayity
 */
class KeyExtractor
{
    const DELIMITER = '.';

    /**
     * @param string $key
     * @return bool
     */
    public static function isNestedKey(string $key):bool
    {
        return strpos($key ,static::DELIMITER) !== false;
    }

    /**
     * @param $key
     *
     * @return array
     */
    public static function getKeyArray($key)
    {
        $keys = [];

        foreach (explode(static::DELIMITER,$key) as $keyPart) {
            $keys[] = $keyPart;
        }

        return $keys;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public static function shiftNestedKey(string $key): string
    {
        $keys = static::getKeyArray($key);
        array_shift($keys);

        return self::toNestedKey($keys);
    }

    /**
     * @param array $keys
     *
     * @return string
     */
    public static function toNestedKey(array $keys)
    {
        return implode(static::DELIMITER, $keys);
    }
}
