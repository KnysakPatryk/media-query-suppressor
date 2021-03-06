<?php

class ReplaceStrategyTest extends PHPUnit_Framework_TestCase
{
    /** @var \KnysakPatryk\MediaQuerySuppressor\Strategy\ReplaceStrategy */
    public $replaceStrategy;
    /** @var \KnysakPatryk\MediaQuerySuppressor\Suppressor */
    public $suppressor;

    public function setUp()
    {
        $this->replaceStrategy = new KnysakPatryk\MediaQuerySuppressor\Strategy\ReplaceStrategy();
        $this->suppressor = new KnysakPatryk\MediaQuerySuppressor\Suppressor($this->replaceStrategy);
    }

    /**
     * @test
     */
    public function can_create_cut_strategy_instance()
    {
        $this->assertTrue($this->replaceStrategy instanceof KnysakPatryk\MediaQuerySuppressor\Strategy\ReplaceStrategy);
    }

    /**
     * @test
     */
    public function it_suppress_max_width_string()
    {
        $inputString = '
        @media (max-width: 768px) {
            .p {
                text-align: center;
            }
        }
        ';

        $expectedString = '
        @media (max-width:1px) {
            .p {
                text-align: center;
            }
        }
        ';

        $this->assertEquals($this->suppressor->one($inputString), $expectedString);
    }

    /**
     * @test
     */
    public function it_suppress_min_width_string()
    {
        $inputString = '
        @media (min-width: 500px) {
            .p {
                text-align: center;
            }
        }
        ';

        $expectedString = '
        @media (min-width:2px) {
            .p {
                text-align: center;
            }
        }
        ';

        $this->assertEquals($this->suppressor->one($inputString), $expectedString);
    }

    /**
     * @test
     */
    public function it_suppress_max_and_min_width_string()
    {
        $inputString = '
        @media (min-width: 992px) and (max-width: 1310px) {
            .p {
                text-align: center;
            }
        }
        ';

        $expectedString = '
        @media (min-width:2px) and (max-width:1px) {
            .p {
                text-align: center;
            }
        }
        ';

        $this->assertEquals($this->suppressor->one($inputString), $expectedString);
    }

    public function it_suppress_max_and_min_width_array()
    {
        $inputArray = [
            '
            @media (min-width: 1310px) {
                .min-width {
                    max-width: 123px
                }
            }
            ',
            '
            @media (min-width: 333px) and (max-width: 1234px)
            ',
            '
            empty
            ',
            '
            @media (max-width: 768px) {
                .p {
                    text-align: center;
                }
            }
            '
        ];

        $expectedArray = [
            '
            @media (min-width:2px) {
                .min-width {
                    max-width: 123px
                }
            }
            ',
            '
            @media (min-width:2px) and (max-width:1px)
            ',
            '
            empty
            ',
            '
            @media (max-width:1px) {
                .p {
                    text-align: center;
                }
            }
            '
        ];

        $this->assertEquals($this->suppressor->many($inputArray), $expectedArray);
    }
}
