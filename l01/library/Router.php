<?php

declare(strict_types=1);

namespace app\library;

use app\exceptions\InvalidConfigException;
use app\exceptions\NotFoundException;
use app\helpers\Strings;

/**
 * Class Router
 * @package app\library
 */
class Router
{
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
     * @throws InvalidConfigException
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
     * @throws InvalidConfigException
     */
    private function getControllerObject(): ControllerAbstract
    {
        $controller = $this->dispatcher->getControllerPart();
        $class = App::getInstance()->getConfig()->getControllerNamespace();
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
}