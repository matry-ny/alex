<?php

namespace app\controllers;

/**
 * Class ExplorerController
 * @package app\controllers
 */
class ExplorerController
{
    public function __construct()
    {
        var_dump(123);
    }

    public function actionView()
    {
        var_dump(__METHOD__);
    }
}