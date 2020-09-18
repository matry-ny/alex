<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = new \app\web\library\Dispatcher();
new \app\library\Router($dispatcher);
