<?php
declare (strict_types = 1);

use tad\FunctionMocker\FunctionMocker;

// require_once \dirname(__DIR__, 2).'/vendor/autoload.php';

FunctionMocker::init([
    'blacklist' => \dirname(__DIR__, 2),
    'cache-path' => __DIR__.'/cache',
    // 'redefinable-internals' => [],
]);
