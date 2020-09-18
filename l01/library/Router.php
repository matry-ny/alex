<?php

declare(strict_types=1);

namespace app\library;

/**
 * Class Router
 * @package app\library
 */
class Router
{
    /**
     * Router constructor.
     * @param DispatcherAbstract $dispatcher
     */
    public function __construct(DispatcherAbstract $dispatcher)
    {
        var_dump($dispatcher->getControllerPart(), $dispatcher->getActionPart());
    }
}