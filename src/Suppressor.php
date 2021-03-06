<?php

namespace KnysakPatryk\MediaQuerySuppressor;

use KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface;

/**
 * This class helps you with "suppressing" media queries in your dynamic content.
 *
 * Class Suppressor
 * @package KnysakPatryk\MediaQuerySuppressor
 */
class Suppressor
{
    /**
     * Suppression strategy class.
     *
     * @var SuppressionStrategyInterface
     */
    private $suppressionStrategy;

    /**
     * Creates instance of Suppression class.
     *
     * @param SuppressionStrategyInterface $suppressionStrategy
     */
    public function __construct(SuppressionStrategyInterface $suppressionStrategy)
    {
        $this->suppressionStrategy = $suppressionStrategy;
    }

    /**
     * Suppress media query in passed string.
     *
     * @param $input
     * @return string
     */
    public function one($input)
    {
        return $this->suppressionStrategy->suppress($input);
    }

    /**
     * Suppress media queries in passed array.
     *
     * @param $array
     * @return array
     */
    public function many($array)
    {
        foreach ($array as $key => $input) {
            $array[$key] = $this->one($input);
        }

        return $array;
    }
}
