<?php

declare(strict_types=1);

error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = new \app\web\library\Dispatcher();
$router = new \app\library\Router($dispatcher);
$router->run();
