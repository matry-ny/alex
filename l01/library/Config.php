<?php


namespace app\library;

use app\exceptions\InvalidConfigException;

/**
 * Class Config
 * @package app\library
 */
class Config
{
    public const COMPONENTS = 'components';
    public const CONTROLLERS_NAMESPACE = 'controllersNamespace';

    /**
     * @var array
     */
    private array $data;

    /**
     * Config constructor.
     * @param array $data
     * @throws InvalidConfigException
     */
    public function __construct(array $data)
    {
        $this->data = $this->prepareData($data);
    }

    /**
     * @return string
     */
    public function getControllerNamespace(): string
    {
        return $this->data[self::CONTROLLERS_NAMESPACE];
    }

    /**
     * @param string $component
     * @return mixed
     * @throws InvalidConfigException
     */
    public function getComponent(string $component)
    {
        if (!isset($this->data[self::COMPONENTS][$component])) {
            throw new InvalidConfigException("Component {$component} is undefined");
        }

        return $this->data[self::COMPONENTS][$component];
    }

    /**
     * @param string $query
     * App::getInstance()->getConfig()->find('components.db.user');
     */
    public function find(string $query)
    {
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidConfigException
     */
    private function prepareData(array $data): array
    {
        if (!array_key_exists(self::CONTROLLERS_NAMESPACE, $data)) {
            throw new InvalidConfigException('Controller namespace is undefined');
        }

        return $data;
    }
}