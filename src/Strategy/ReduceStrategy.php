<?php

namespace KnysakPatryk\MediaQuerySuppressor\Strategy;

/**
 * This strategy is improved cut strategy.
 * It replaces min-width directives with corresponding replacements starting from 1px.
 *
 * Class ReduceStrategy
 * @package KnysakPatryk\MediaQuerySuppressor\Strategy
 */
class ReduceStrategy implements SuppressionStrategyInterface
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
        return preg_replace("#\((\s*max-width\s*)\s*:([^\)]*)\)#xi", "(max-width:1px)", $input);
    }

    /**
     * Replaces min-width media queries with corresponding version counting from 1px.
     *
     * @param $input
     * @return string
     */
    private function reduceMinWidth($input)
    {
        preg_match_all("#\((\s*min-width\s*)\s*:\s*(\d+)\s*px\)#xi", $input, $mediaQueries);

        if (isset($mediaQueries[2]) && count($mediaQueries[2]) > 0) {
            $regexRule = [];
            $regexReplace = [];
            $currentWidth = 1;
            $arrayToProcess = array_unique($mediaQueries[2]);
            asort($arrayToProcess);

            foreach ($arrayToProcess as $width) {
                $regexRule[] = "#\((\s*min-width\s*)\s*:\s*{$width}\s*px\)#xi";
                $regexReplace[] = "(min-width:{$currentWidth}px)";
                $currentWidth++;
            }

            return preg_replace($regexRule, $regexReplace, $input);
        }

        return $input;
    }
}
