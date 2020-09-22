<?php

declare(strict_types=1);

namespace app\library;

use app\cli\library\Dispatcher as CliDispatcher;
use app\exceptions\NotFoundException;
use app\helpers\Strings;

/**
 * Class Router
 * @package app\library
 */
class Router
{
    private const CLI_NAMESPACE = 'app\\cli\\controllers\\';
    private const WEB_NAMESPACE = 'app\\web\\controllers\\';

    private const CONTROLLER_SUFFIX = 'Controller';

    private DispatcherAbstract $dispatcher;

    /**
     * Router constructor.
     * @param DispatcherAbstract $dispatcher
     */
    public function __construct(DispatcherAbstract $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return mixed
     * @throws NotFoundException
     */
    public function run()
    {
        $controller = $this->getControllerObject();
        $action = $this->getActionMethod($controller);

        return $controller->{$action}();
    }

    /**
     * @return ControllerAbstract
     * @throws NotFoundException
     */
    private function getControllerObject(): ControllerAbstract
    {
        $controller = $this->dispatcher->getControllerPart();
        $class = $this->getControllersNamespace();
        $class .= Strings::camelize($controller);
        $class .= self::CONTROLLER_SUFFIX;

        if (!class_exists($class)) {
            throw new NotFoundException("Class {$class} is undefined");
        }

        $object = new $class();
        if (!$object instanceof ControllerAbstract) {
            throw new NotFoundException("Object of {$class} has incorrect instance");
        }

        $object->setControllerName($controller);

        return $object;
    }

    /**
     * @param ControllerAbstract $controller
     * @return string
     * @throws NotFoundException
     */
    private function getActionMethod(ControllerAbstract $controller): string
    {
        $action = $this->dispatcher->getActionPart();
        $method = 'action';
        $method .= Strings::camelize($action);

        if (!method_exists($controller, $method)) {
            throw new NotFoundException("Action {$action} is undefined");
        }

        $controller->setActionName($action);

        return $method;
    }

    /**
     * @return string
     *
     * ToDo: Move to configuration file
     */
    private function getControllersNamespace(): string
    {
        if ($this->dispatcher instanceof CliDispatcher) {
            return self::CLI_NAMESPACE;
        }

        return self::WEB_NAMESPACE;
    }
}