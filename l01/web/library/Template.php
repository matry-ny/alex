<?php

namespace app\web\library;

use app\exceptions\NotFoundException;

/**
 * Class Template
 * @package app\web\library
 */
class Template
{
    public string $content = '';
    public array $params = [];

    private string $viewsDir;
    private string $layout;
    private string $ext;

    /**
     * Template constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->viewsDir = $config['viewsDir'] ?? __DIR__ . '/../views/';
        $this->layout = $config['layout'] ?? 'layouts/general';
        $this->ext = $config['extension'] ?? '.php';
    }

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

        $layout = $this->getTemplateRout($this->layout);
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
        if (substr($view, -strlen($this->ext)) !== $this->ext) {
            $view .= $this->ext;
        }

        $rout = $this->viewsDir . $view;
        if (!file_exists($rout)) {
            throw new NotFoundException("Template {$view} is undefined");
        }

        return $rout;
    }
}
