<?php

include_once '../vendor/autoload.php';

use \Arrayity\Storage;

$array = [
  'test',
  'array1' => [
      'array2' => [
          'array21' => [
              'test'
          ]
      ],
      [
          'array3' => [
              'test3' => 1
          ]
      ]
  ]
];


$obj = new Storage($array);

var_dump($obj->get('array1.array2.array21.0'));

