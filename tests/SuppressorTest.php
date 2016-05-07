<?php

use KnysakPatryk\MediaQuerySuppressor\Suppressor;

class SuppressorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_create_suppressor_instance()
    {
        $mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $suppressor = new Suppressor($mock);

        $this->assertTrue($suppressor instanceof \KnysakPatryk\MediaQuerySuppressor\Suppressor);
    }

    /**
     * @test
     */
    public function it_calls_suppress_method_from_passed_class_one_time()
    {
        $mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $suppressor = new Suppressor($mock);

        $mock->expects($this->once())
            ->method('suppress');

        $suppressor->one(null);
    }

    /**
     * @test
     */
    public function it_calls_suppress_method_from_passed_class_twice()
    {
        $mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $suppressor = new Suppressor($mock);

        $mock->expects($this->exactly(2))
            ->method('suppress');

        $suppressor->many([null, null]);
    }

    /**
     * @test
     */
    public function it_returns_given_string()
    {
        $string = 'testing';
        $mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $suppressor = new Suppressor($mock);

        $mock->expects($this->once())
            ->method('suppress')
            ->willReturn($string);

        $result = $suppressor->one($string);
        $this->assertEquals($result, $string);
    }

    /**
     * @test
     */
    public function it_returns_given_array()
    {
        $array = ['testing1', 'testing2', 'testing3'];
        $mock = $this->getMock('\KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface');
        $suppressor = new Suppressor($mock);

        $mock->expects($this->exactly(3))
            ->method('suppress')
            ->will($this->returnArgument(0));

        $result = $suppressor->many($array);
        $this->assertEquals($result, $array);
    }
}