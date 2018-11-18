<?php
namespace Khalyomede;

use OutOfBoundsException;

/**
 * Turn a dot/star syntax and return the assocated value.
 * 
 * @category Class
 * 
 * @package ArrayGet
 * 
 * @author Khalyomede <Khalyomede@gmail.com>
 * 
 * @license https://github.com/khalyomede/array-get/blob/master/LICENCE MIT
 * 
 * @link https://github.com/khalyomede/array-get/blob/master/src/Arr.php
 */
class Arr
{
    /**
     * Holds the array.
     * 
     * @var array
     */
    protected $array;

    /**
     * The more we traverse, the more this array is filled by the current key. Used to report an error.
     * 
     * @var array<string>
     */
    protected $keys;

    /**
     * Constructor.
     * 
     * @param array $array The array to traverse.
     */
    public function __construct(array $array) 
    {
        $this->array = $array;
        $this->keys = [];
    }

    /**
     * Traverse an array using the key and return its value.
     * 
     * @param string $key The key (supports dot and star syntax).
     * 
     * @return mixed
     * 
     * @throws OutOfBoundsException If the key does not exist.
     */
    public function get(string $key) 
    {
        $this->keys = [];

        return static::_traverse($this, $this->array, $key);
    }

    /**
     * Traverse an array using a key and return the value.
     * 
     * @param self   $instance The Arr instance calling this method.
     * 
     * @param array  $array The array to traverse.
     * 
     * @param string $key The key to use to traverse the array.
     * 
     * @return mixed
     * 
     * @throws OutOfBoundsException If the key does not exist.
     */
    private static function _traverse(self $instance, array $array, string $key) 
    {
        $keys = explode('.', $key);
        $firstKey = $keys[0];

        if (count($keys) === 1) {
            if ($firstKey === '*') {
                return $array;
            } else if (array_key_exists($firstKey, $array) === true) {
                return $array[$firstKey];
            } else {
                $instance->keys[] = $firstKey;

                throw new OutOfBoundsException("Undefined offset: {$instance->_key()}");
            }
        } else {
            $instance->keys[] = $firstKey;

            $otherKeysList = array_slice($keys, 1);
            $otherKeys = implode('.', $otherKeysList);

            if ($firstKey === '*') {
                $value = [];

                foreach ($array as $item) {
                    if (is_array($item) === false) {
                        $instance->keys[] = $otherKeysList[0];

                        throw new OutOfBoundsException("Undefined offset: {$instance->_key()}");
                    }

                    array_push($value, static::_traverse($instance, $item, $otherKeys));
                }

                return $value;
            } else if (is_numeric($firstKey) === true && is_int((int) $firstKey) === true) {
                if (array_key_exists($firstKey, $array) === true) {
                    $value = $array[$firstKey];

                    return static::_traverse($instance, $value, $otherKeys);
                } else {
                    throw new OutOfBoundsException("Undefined offset: {$instance->_key()}");
                }
            } else {
                if (array_key_exists($firstKey, $array) === true) {
                    $value = $array[$firstKey];

                    if (is_array($value) === false) {
                        $instance->keys[] = $otherKeysList[0];

                        throw new OutOfBoundsException("Undefined offset: {$instance->_key()}");
                    }

                    return static::_traverse($instance, $value, $otherKeys);
                } else {
                    throw new OutOfBoundsException("Undefined offset: {$instance->_key()}");
                }
            }
        }
    }

    /**
     * Return the current key.
     * 
     * @return string
     */
    private function _key(): string {
        return implode('.', $this->keys);
    }
}
?>