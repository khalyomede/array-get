<?php
namespace Khalyomede;

use Khalyomede\Arr;

if (function_exists('array_get') === false) {
    /**
     * Traverse the array using dot and star syntax and returns the value.
     * 
     * @param array $array The array to traverse.
     * 
     * @param string $key The key to use to traverse the array.
     * 
     * @return mixed
     * 
     * @throws \OutOfBoundsException If the key does not exist in the array.
     */
    function array_get(array $array, string $key) {
        return (new Arr($array))->get($key);
    }
}
?>