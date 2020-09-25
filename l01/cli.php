<?php

declare(strict_types=1);

error_reporting(E_ALL);

use app\cli\library\Dispatcher;
use app\library\App;

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/configs/cli.php';
$dispatcher = new Dispatcher();

App::getInstance()
    ->setConfig($config)
    ->setDispatcher($dispatcher)
    ->run();
