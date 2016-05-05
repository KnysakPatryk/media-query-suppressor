<?php

use KnysakPatryk\MediaQuerySuppressor\Suppressor;

require '../vendor/autoload.php';

new Suppressor(new \KnysakPatryk\MediaQuerySuppressor\Strategy\ReduceStrategy());