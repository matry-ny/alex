<?php

namespace app\web\library;

use app\exceptions\NotFoundException;
use app\library\App;
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
        $templateConfig = App::getInstance()->getConfig()->getComponent('template');
        $this->view = new Template($templateConfig);
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
     * @throws NotFoundException
     */
    public function render(array $params = []): string
    {
        $view = "{$this->controllerName}/{$this->actionName}";
        return $this->getView()->render($view, $params);
    }
}
