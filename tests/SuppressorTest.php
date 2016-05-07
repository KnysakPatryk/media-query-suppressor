<?php

use KnysakPatryk\MediaQuerySuppressor\Suppressor;

class SuppressorTest extends PHPUnit_Framework_TestCase
{
    public $mock;
    public $suppressor;

    public function setUp()
    {
        $this->mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $this->suppressor = new Suppressor($this->mock);
    }

    /**
     * @test
     */
    public function can_create_suppressor_instance()
    {


        $this->assertTrue($this->suppressor instanceof \KnysakPatryk\MediaQuerySuppressor\Suppressor);
    }

    /**
     * @test
     */
    public function it_calls_suppress_method_from_passed_class_one_time()
    {
        $this->mock->expects($this->once())
            ->method('suppress');

        $this->suppressor->one(null);
    }

    /**
     * @test
     */
    public function it_calls_suppress_method_from_passed_class_twice()
    {
        $this->mock->expects($this->exactly(2))
            ->method('suppress');

        $this->suppressor->many([null, null]);
    }

    /**
     * @test
     */
    public function it_returns_given_string()
    {
        $string = 'testing';

        $this->mock->expects($this->once())
            ->method('suppress')
            ->willReturn($string);

        $result = $this->suppressor->one($string);
        $this->assertEquals($result, $string);
    }

    /**
     * @test
     */
    public function it_returns_given_array()
    {
        $array = ['testing1', 'testing2', 'testing3'];

        $this->mock->expects($this->exactly(3))
            ->method('suppress')
            ->will($this->returnArgument(0));

        $result = $this->suppressor->many($array);
        $this->assertEquals($result, $array);
    }
}