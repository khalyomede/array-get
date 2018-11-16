<?php
use PHPUnit\Framework\TestCase;
use Khalyomede\Arr;

class ArrTest extends TestCase 
{
    const FIRSTNAME = 'John';
    const AGE = 42;
    const HOBBIES = ['programming', 'workout', 'sleeping'];
    const ORDERED_AT = '2018-11-16 23:45:00';
    const PRODUCT_NAME = 'Tesla Powerbank';
    const ORDER_2 = [
        'id' => 60,
        'ordered_at' => '2018-11-16 23:50:00',
        'product' => [
            'id' => 209,
            'name' => 'Huawei P20'
        ]
    ];
    const FIRST_JOB = ['id' => 32, 'name' => 'cron send email'];
    const SECOND_JOB = ['id' => 33, 'name' => 'remove unused rows'];

    /**
     * @var array
     */
    protected $arr;

    protected function setUp() 
    {
        $this->arr = new Arr([
            'firstname' => static::FIRSTNAME,
            'lastname' => 'Doe',
            'age' => static::AGE,
            'hobbies' => static::HOBBIES,
            'orders' => [
                [
                    'id' => 59,
                    'ordered_at' => static::ORDERED_AT,
                    'product' => [
                        'id' => 41,
                        'name' => static::PRODUCT_NAME
                    ]
                ],
                static::ORDER_2
            ]
        ]);

        $this->arr2 = new Arr([
            static::FIRST_JOB,
            static::SECOND_JOB
        ]);
    }

    public function testAccessKey()
    {
        $this->assertEquals($this->arr->get('firstname'), static::FIRSTNAME);
    }

    public function testAccessStar()
    {
        $this->assertEquals($this->arr->get('hobbies.*'), static::HOBBIES);
    }

    public function testAccessNestedItemByStar()
    {
        $this->assertEquals($this->arr->get('orders.*.id'), [59, 60]);
    }
    
    public function testAccessItemofArrayInsideNestedItemByStar()
    {
        $this->assertEquals($this->arr->get('orders.*.product.name'), [static::PRODUCT_NAME, 'Huawei P20']);
    }

    public function testAccessKeyThatIsArray()
    {
        $this->assertEquals($this->arr->get('hobbies'), static::HOBBIES);
    }

    public function testAccessKeyThatIsInteger()
    {
        $this->assertEquals($this->arr->get('age'), static::AGE);
    }

    public function testAccessItemOfArrayByIndex()
    {
        $this->assertEquals($this->arr->get('orders.1'), static::ORDER_2);
    }

    public function testAccessNestedItemOfArrayByIndex()
    {
        $this->assertEquals($this->arr->get('orders.0.ordered_at'), static::ORDERED_AT);
    }

    public function testAccessFirstKey()
    {
        $this->assertEquals($this->arr2->get('0'), static::FIRST_JOB);
    }

    public function testAccessAllKeysByStar() 
    {
        $this->assertEquals($this->arr2->get('*'), [static::FIRST_JOB, static::SECOND_JOB]);
    }

    public function testAccessUndefinedKey()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('foo');
    }

    public function testAccessUndefinedKeyMessage()
    {
        $this->expectExceptionMessage('Undefined offset: foo');

        $this->arr->get('foo');
    }

    public function testAccessUndefinedKeyPlusAnotherUndefined()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('foo.firstname');
    }

    public function testAccessUndefinedKeyPlusAnotherUndefinedMessage()
    {
        $this->expectExceptionMessage('Undefined offset: foo');

        $this->arr->get('foo.firstname');
    }

    public function testAccessUndefinedStar()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('firstname.*');
    }

    public function testAccessUndefinedStarMessage()
    {
        $this->expectExceptionMessage('Undefined offset: firstname.*');

        $this->arr->get('firstname.*');
    }

    public function testAccessUndefinedStarPlusAnotherUndefinedStar()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('firstname.*.product');
    }

    public function testAccessUndefinedStarPlusAnotherUndefinedStarMessage()
    {
        $this->expectExceptionMessage('Undefined offset: firstname.*');

        $this->arr->get('firstname.*.product');
    }

    public function testAccessUndefinedIndexOfArray() {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('orders.2');
    }

    public function testAccessUndefinedIndexOfArrayMessage() {
        $this->expectExceptionMessage('Undefined offset: orders.2');

        $this->arr->get('orders.2');
    }

    public function testAccessUndefinedIndexOfArrayPlusAnotherUndefinedKey() {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('orders.2.name');
    }

    public function testAccessUndefinedIndexOfArrayPlusAnotherUndefinedKeyMessage() {
        $this->expectExceptionMessage('Undefined offset: orders.2');

        $this->arr->get('orders.2.name');
    }

    public function testAccessAllKeysBytNotAllRowsHasThisKey()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->arr->get('*.firstname');
    }

    public function testAccessAllKeysBytNotAllRowsHasThisKeyMessage()
    {
        $this->expectExceptionMessage('Undefined offset: *.firstname');

        $this->arr->get('*.firstname');
    }
}
?>