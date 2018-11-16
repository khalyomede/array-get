<?php
require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Arr;

$array = [
    'firstname' => 'John',
    'lastname' => 'Doe',
    'orders' => []
];

$firstname = (new Arr($array))->get('firstname');

var_dump($firstname); // "John"
?>