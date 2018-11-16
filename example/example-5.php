<?php
require __DIR__ . '/../vendor/autoload.php';

use function Khalyomede\array_get;

$tasks = [
    ['id' => 53, 'name' => 'read mails'],
    ['id' => 61, 'name' => 'factorize the code'],
    ['id' => 71, 'name' => 'learn ES8 & ES9']
];

var_dump( array_get($tasks, '*.name') ); // ["read mails", "factorize the code", "learn ES8 & ES9"]
?>