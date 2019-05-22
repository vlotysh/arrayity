<?php

namespace Arrayity;

/**
 * Class ArrayFactory
 *
 * @package Arrayity
 */
class Arrayity
{
    /**
     * @var array
     */
    private $data;

    private $nameConverter;

    /**
     * ArrayFactory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->nameConverter = new NameConverter();
    }

    public function get($name)
    {

    }

    public function __get(string $name)
    {

    }
}
