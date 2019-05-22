<?php


namespace Arrayity;

use \Closure;

/**
 * Class Storage
 * @package Arrayity
 */
class Storage
{
    /**
     * @var array
     */
    private $data;

    /**
     * Storage constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $result = $this->findByKey($key, $this->data);

        return $result !== -1 ? $result : $default;
    }

    private function findByKey($key, $scope = [])
    {
        if (KeyExtractor::isNestedKey($key)) {
            $keys = KeyExtractor::getKeyArray($key);
            $scope = $this->getByKey(current($keys), $scope);

            return $this->findByKey(KeyExtractor::shiftNestedKey($key), $scope);
        } else {
            return $this->getByKey($key, $scope);
        }
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->data);
    }


    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->data);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function remove($key)
    {
        if (! isset($this->data[$key]) && ! array_key_exists($key, $this->data)) {
            return null;
        }
        $removed = $this->data[$key];
        unset($this->data[$key]);

        return $removed;
    }

    /**
     * @param $element
     *
     * @return bool
     */
    public function removeElement($element) : bool
    {
        $key = array_search($element, $this->data, true);

        if ($key === false) {
            return false;
        }

        unset($this->data[$key]);

        return true;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count($this->data);
    }

    /**
     * @param $element
     *
     * @return false|int|string
     */
    public function indexOf($element)
    {
        return array_search($element, $this->data, true);
    }

    /**
     * @param Closure $callback
     * @return Storage
     */
    public function filter(Closure $callback)
    {
        return new static(array_filter($this->data, $callback, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * @param $key
     * @param array $scope
     *
     * @return int|mixed
     */
    private function getByKey($key, $scope = [])
    {
        if (count($scope) === 0) {
            $scope = $this->data;
        }

        if (!isset($scope[$key])) {
            return -1;
        }

        return $scope[$key];
    }
}
