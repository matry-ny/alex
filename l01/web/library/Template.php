<?php

namespace app\web\library;

use app\exceptions\NotFoundException;

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
    private const LAYOUT = 'layouts/general';
    private const EXT = '.php';

    public string $content = '';
    public array $params = [];

    /**
     * @param string $view
     * @param array $params
     * @return string
     * @throws NotFoundException
     */
    public function render(string $view, array $params = []): string
    {
        $this->params = $params;

        $template = $this->getTemplateRout($view);
        $this->content = $this->getTemplateContent($template);

        $layout = $this->getTemplateRout(self::LAYOUT);
        return $this->getTemplateContent($layout);
    }

    /**
     * @param string $template
     * @return string
     */
    private function getTemplateContent(string $template): string
    {
        ob_start();
        require_once $template;
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @return string
     * @throws NotFoundException
     */
    private function getTemplateRout(string $view): string
    {
        if (substr($view, -strlen(self::EXT)) !== self::EXT) {
            $view .= self::EXT;
        }

        $rout = self::VIEWS_DIR . $view;
        if (!file_exists($rout)) {
            throw new NotFoundException("Template {$view} is undefined");
        }

        return $rout;
    }
}
