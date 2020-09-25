<?php

namespace app\web\controllers;

use app\web\library\WebControllerAbstract;

/**
 * Class ExplorerController
 * @package app\web\controllers
 */
class ExplorerController extends WebControllerAbstract
{
    public function actionView()
    {
        $files = scandir(__DIR__);
        echo $this->render(['tet' => 23123, 's' => [1, 2]]);
    }
}