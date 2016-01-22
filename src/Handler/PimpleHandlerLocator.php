<?php

namespace Pimple\Tactician\Provider\Handler;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Pimple\Container;

class PimpleHandlerLocator implements HandlerLocator
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandlerForCommand($commandName)
    {
        $handlerId = 'app.command.' . str_replace('_command', '_handler', $commandName);

        try {
            return $this->container[$handlerId];
        } catch (\InvalidArgumentException $e) {
            throw MissingHandlerException::forCommand($commandName);
        }
    }
}
