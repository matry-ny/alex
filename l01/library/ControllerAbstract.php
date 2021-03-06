<?php

namespace app\library;

/**
 * Class ControllerAbstract
 * @package app\library
 */
class ControllerAbstract
{
    /**
     * @var string
     */
    protected string $controllerName = '';

    /**
     * @var string
     */
    protected string $actionName = '';

    /**
     * @param string $controllerName
     * @return $this
     */
    public function setControllerName(string $controllerName): self
    {
        if ($this->controllerName) {
            return $this;
        }

        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @param string $actionName
     * @return $this
     */
    public function setActionName(string $actionName): self
    {
        if ($this->actionName) {
            return $this;
        }

        $this->actionName = $actionName;
        return $this;
    }
}
