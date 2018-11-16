<?php
require __DIR__ . '/../vendor/autoload.php';

use function Khalyomede\array_get;

$array = [
  'firstname' => 'John',
  'lastname' => 'Doe',
  'orders' => [
    [
      'id' => 36,
      'ordered_at' => '2018-11-16 22:12:38',
      'product' => [
        'id' => 11,
        'name' => 'Huawei P20'
      ]
    ],
    [
      'id' => 47,
      'ordered_at' => '2018-11-16 22:13:04',
      'product' => [
        'id' => 208,
        'name' => 'Powerbank Tesla'
      ]
    ]
  ]
];

$ordered_at = array_get($array, 'orders.1.ordered_at');

var_dump($ordered_at); // "2018-11-16 22:13:04"
?>