<?php

namespace app\library;

/**
 * Class DispatcherAbstract
 * @package app\library
 */
abstract class DispatcherAbstract
{
    private const DEFAULT_PART = 'index';

    /**
     * @var string
     */
    protected string $controllerPart = '';

    /**
     * @var string
     */
    protected string $actionPart = '';

    /**
     * @var string[]
     */
    private array $parts;

    /**
     * @return string
     */
    public function getControllerPart(): string
    {
        $this->parseParts();
        return $this->controllerPart;
    }

    /**
     * @return string
     */
    public function getActionPart(): string
    {
        $this->parseParts();
        return $this->actionPart;
    }

    abstract protected function dispatch(): void;

    /**
     * @param string[] $parts
     */
    protected function setParts(array $parts): void
    {
        $this->parts = array_filter($parts);
    }

    private function parseParts(): void
    {
        if ($this->controllerPart && $this->actionPart) {
            return;
        }

        $this->dispatch();

        $this->controllerPart = $this->parts ? array_shift($this->parts) : self::DEFAULT_PART;
        $this->actionPart = $this->parts ? array_shift($this->parts) : self::DEFAULT_PART;
    }
}
