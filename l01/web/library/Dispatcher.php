<?php

namespace app\web\library;

use app\library\DispatcherAbstract;

/**
 * Class Dispatcher
 * @package app\web\library
 */
class Dispatcher extends DispatcherAbstract
{
    protected function dispatch(): void
    {
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], " \t\n\r\0\x0B/"));
        $this->setParts($parts);
    }
}
