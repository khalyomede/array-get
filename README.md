# array-get

Function to traverse an array using dot and star syntax. Inspired by [Laravel](https://laravel.com) Validator class.



![PHP from Packagist](https://img.shields.io/packagist/php-v/khalyomede/array-get.svg) ![Packagist](https://img.shields.io/packagist/v/khalyomede/array-get.svg) ![Codeship](https://img.shields.io/codeship/4b0928b0-cc1d-0136-7e9d-7e574d5ffb69.svg) ![Packagist](https://img.shields.io/packagist/l/khalyomede/array-get.svg)


```php
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

var_dump( array_get($array, 'firstname') ); // "John"
var_dump( array_get($array, 'orders.1.ordered_at') ); // "2018-11-16 22:13:04"
var_dump( array_get($array, 'orders.*.product.name') ) // ["Huawei P20", "Powerbank Tesla"]
```

## Summary

- [Installation](#installation)
- [Examples](#examples)

## Installation

In your project directory:

```bash
composer require khalyomede/array-get:0.*
```

## Examples

- [Example 1: get a value from a key](#example-1-get-a-value-from-a-key)
- [Example 2: get a value from an indexed key](#example-2-get-a-value-from-an-indexed-key)
- [Example 3: get values from a nested key](#example-3-get-values-from-a-nested-key)
- [Example 4: use OOP style](#example-4-use-oop-style)
- [Example 5: get the key of each items](#example-5-get-the-key-of-each-items)

### Example 1: get a value from a key

```php
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

$firstname = array_get($array, 'firstname');

var_dump($firstname); // "John"
```

### Example 2: get a value from an indexed key

```php
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
```

### Example 3: get values from a nested key

```php
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

$ordered_at = array_get($array, 'orders.*.product.name');

var_dump($ordered_at); // ["Huawei P20", "Powerbank Tesla"]
```

### Example 4: use OOP style

```php
require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Arr;

$array = [
  'firstname' => 'John',
  'lastname' => 'Doe',
  'orders' => []
];

$firstname = (new Arr($array))->get('firstname');

var_dump($firstname); // "John"
```

### Example 5: get the key of each items

```php
require __DIR__ . '/../vendor/autoload.php';

use function Khalyomede\array_get;

$tasks = [
    ['id' => 53, 'name' => 'read mails'],
    ['id' => 61, 'name' => 'factorize the code'],
    ['id' => 71, 'name' => 'learn ES8 & ES9']
];

var_dump( array_get($tasks, '*.name') ); // ["read mails", "factorize the code", "learn ES8 & ES9"]
```