<?php

class ReduceStrategyTest extends PHPUnit_Framework_TestCase
{
    /** @var \KnysakPatryk\MediaQuerySuppressor\Strategy\ReduceStrategy */
    public $reduceStrategy;
    /** @var \KnysakPatryk\MediaQuerySuppressor\Suppressor */
    public $suppressor;

    public function setUp()
    {
        $this->reduceStrategy = new KnysakPatryk\MediaQuerySuppressor\Strategy\ReduceStrategy();
        $this->suppressor = new KnysakPatryk\MediaQuerySuppressor\Suppressor($this->reduceStrategy);
    }

    /**
     * @test
     */
    public function can_create_cut_strategy_instance()
    {
        $this->assertTrue($this->reduceStrategy instanceof KnysakPatryk\MediaQuerySuppressor\Strategy\ReduceStrategy);
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
            @media (min-width: 500px) {
                @media (min-width: 501px) {
                    @media (min-width: 50px) {
                        .max-width: 1px
                        .min-width: 2px
                    }
                }
            }
        }
        ';

        $expectedString = '
        @media (min-width:2px) {
            .p {
                text-align: center;
            }
            @media (min-width:2px) {
                @media (min-width:3px) {
                    @media (min-width:1px) {
                        .max-width: 1px
                        .min-width: 2px
                    }
                }
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
            @media (min-width: 15px) and (max-width: 1310px) {
                @media (min-width: 1992px) and (max-width: 1310px) {
                }
            }
        }
        ';

        $expectedString = '
        @media (min-width:2px) and (max-width:1px) {
            .p {
                text-align: center;
            }
            @media (min-width:1px) and (max-width:1px) {
                @media (min-width:3px) and (max-width:1px) {
                }
            }
        }
        ';

        $this->assertEquals($this->suppressor->one($inputString), $expectedString);
    }

    public function it_suppress_max_and_min_width_array()
    {
        $inputArray = [
            '
            @media (max-width: 768px) {
                .p {
                    text-align: center;
                }
            }
            ',
            '
            @media (min-width: 500px) {
                .p {
                    text-align: center;
                }
                @media (min-width: 500px) {
                    @media (min-width: 501px) {
                        @media (min-width: 50px) {
                            .max-width: 1px
                            .min-width: 2px
                        }
                    }
                }
            }
            ',
            '
            @media (min-width: 992px) and (max-width: 1310px) {
                .p {
                    text-align: center;
                }
                @media (min-width: 15px) and (max-width: 1310px) {
                    @media (min-width: 1992px) and (max-width: 1310px) {
                    }
                }
            }
            '
        ];

        $expectedArray = [
            '
            @media (max-width:1px) {
                .p {
                    text-align: center;
                }
            }
            ',
            '
            @media (min-width:2px) {
                .p {
                    text-align: center;
                }
                @media (min-width:2px) {
                    @media (min-width:3px) {
                        @media (min-width:1px) {
                            .max-width: 1px
                            .min-width: 2px
                        }
                    }
                }
            }
            ',
            '
            @media (min-width:2px) and (max-width:1px) {
                .p {
                    text-align: center;
                }
                @media (min-width:1px) and (max-width:1px) {
                    @media (min-width:3px) and (max-width:1px) {
                    }
                }
            }
            '
        ];

        $this->assertEquals($this->suppressor->many($inputArray), $expectedArray);
    }
}
