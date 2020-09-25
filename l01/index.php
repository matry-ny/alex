<?php

declare(strict_types=1);

error_reporting(E_ALL);

use app\library\App;
use app\web\library\Dispatcher;

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/configs/web.php';
$dispatcher = new Dispatcher();

App::getInstance()
    ->setConfig($config)
    ->setDispatcher($dispatcher)
    ->run();
