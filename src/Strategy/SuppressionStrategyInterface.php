<?php

namespace KnysakPatryk\MediaQuerySuppressor\Strategy;

/**
 * Interface SuppressionStrategyInterface
 * @package KnysakPatryk\MediaQuerySuppressor\Strategy
 */
// @codeCoverageIgnore
interface SuppressionStrategyInterface
{
    /**
     * Performs suppression strategry on given input.
     *
     * @param $input
     * @return string
     */
    public function suppress($input);
}
