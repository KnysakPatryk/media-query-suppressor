<?php

namespace KnysakPatryk\MediaQuerySuppressor;

use KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface;

class Suppressor
{
    private $suppressionStrategy;

    function __construct(SuppressionStrategyInterface $suppressionStrategy)
    {
        $this->suppressionStrategy = $suppressionStrategy;
    }

    function one($input)
    {
        return $this->suppressionStrategy->suppress($input);
    }

    function many($inputs)
    {
        foreach ($inputs as $key => $input) {
            $inputs[$key] = $this->suppressionStrategy->suppress($input);
        }

        return $inputs;
    }
}