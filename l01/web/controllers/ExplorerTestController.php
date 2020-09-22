<?php

namespace app\web\controllers;

use app\web\library\WebControllerAbstract;

/**
 * Class ExplorerController
 * @package app\web\controllers
 */
class ExplorerTestController extends WebControllerAbstract
{
    public function actionView()
    {
        $files = scandir(__DIR__);
        $this->render();
    }
}