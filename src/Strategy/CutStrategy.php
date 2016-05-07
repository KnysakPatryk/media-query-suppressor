<?php

namespace KnysakPatryk\MediaQuerySuppressor\Strategy;

/**
 * The simplest way to remove media queries (although not so good).
 *
 * Warning!
 * This suppression strategy have one main issue.
 * It replaces all min-width with the same value,
 * so place of media query directive in file really matters.
 *
 * Class CutStrategy
 * @package KnysakPatryk\MediaQuerySuppressor\Strategy
 */
class CutStrategy implements SuppressionStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function suppress($input)
    {
        $input = $this->reduceMinWidth($input);
        $input = $this->reduceMaxWidth($input);

        return $input;
    }

    /**
     * Replaces max-width media queries with 1px version.
     *
     * @param $input
     * @return string
     */
    private function reduceMaxWidth($input)
    {
        return preg_replace("#\((\s*max-width\s*)\s*:(.*)\)#xi", "(max-width:1px)", $input);
    }

    /**
     * Replaces min-width media queries with 2px version.
     *
     * @param $input
     * @return string
     */
    private function reduceMinWidth($input)
    {
        return preg_replace("#\((\s*min-width\s*)\s*:(.*)\)#xi", "(min-width:2px)", $input);
    }
}