<?php

namespace Pimple\Tactician\Provider;

use League\Tactician\CommandBus;

trait CommandBusAwareTrait
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function setCommandBus(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}
