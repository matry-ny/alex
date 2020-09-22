<?php

namespace app\web\library;

use app\library\ControllerAbstract;

/**
 * Class WebControllerAbstract
 * @package app\web\library
 */
class WebControllerAbstract extends ControllerAbstract
{
    /**
     * @var Template
     */
    private Template $view;

    /**
     * WebControllerAbstract constructor.
     */
    public function __construct()
    {
        $this->view = new Template();
    }

    /**
     * @return Template
     */
    public function getView(): Template
    {
        return $this->view;
    }

    /**
     * @param array $params
     * @return string
     */
    public function render(array $params = []): string
    {
        $view = "{$this->controllerName}/{$this->actionName}.php";
        return $this->getView()->render($view, $params);
    }
}
