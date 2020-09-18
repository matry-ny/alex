<?php

namespace app\cli\library;

use app\library\DispatcherAbstract;

/**
 * Class Dispatcher
 * @package app\cli\library
 */
class Dispatcher extends DispatcherAbstract
{
    protected function dispatch(): void
    {
        $address = $_SERVER['argv'][1] ?? '';
        $parts = explode('::', trim($address));
        $this->setParts($parts);
    }
}