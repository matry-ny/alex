<?php

declare(strict_types=1);

namespace app\library;

use app\exceptions\InvalidConfigException;

/**
 * Class App
 * @package app\library
 */
class App
{
    /**
     * @var App|null
     */
    private static ?App $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @var Config|null
     */
    private ?Config $config = null;

    /**
     * @var DispatcherAbstract|null
     */
    private ?DispatcherAbstract $dispatcher = null;

    /**
     * @param array $config
     * @return $this
     * @throws InvalidConfigException
     */
    public function setConfig(array $config): self
    {
        $this->config = new Config($config);
        return $this;
    }

    /**
     * @return Config
     * @throws InvalidConfigException
     */
    public function getConfig(): Config
    {
        if (!$this->config) {
            throw new InvalidConfigException('Config is undefined');
        }

        return $this->config;
    }

    /**
     * @param DispatcherAbstract $dispatcher
     * @return $this
     */
    public function setDispatcher(DispatcherAbstract $dispatcher): self
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

    public function run(): void
    {
        if (!$this->dispatcher) {
            throw new InvalidConfigException('Dispatcher is undefined');
        }

        $router = new Router($this->dispatcher);
        echo $router->run();
    }
}
