<?php

namespace KnysakPatryk\MediaQuerySuppressor;

use KnysakPatryk\MediaQuerySuppressor\Strategy\SuppressionStrategyInterface;

class Suppressor
{
    private $suppressionStrategy;

    function __construct(SuppressionStrategyInterface $suppressionStrategy) {
        $this->suppressionStrategy = $suppressionStrategy;
    }

        
}