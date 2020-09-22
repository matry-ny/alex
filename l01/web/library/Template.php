<?php

namespace app\web\library;

/**
 * Class Template
 * @package app\web\library
 */
class Template
{
    /**
     * ToDo: Move to config
     */
    private const VIEWS_DIR = __DIR__ . '/../views/';

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return $view . ' ==> ' . json_encode($params);
    }
}
