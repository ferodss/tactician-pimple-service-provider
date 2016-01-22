<?php

namespace Pimple\Test\Tactician\Provider\Handler;

use Pimple\Container;
use Pimple\Tactician\Provider\Handler\PimpleHandlerLocator;

class PimpleHandlerLocatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsGettingHandler()
    {
        $commandName = 'fake_command';
        $handlerId = 'app.command.fake_handler';
        $handler = new \stdClass();

        $container = $this->prophesize(Container::class);
        $container->offsetGet($handlerId)->willReturn($handler);

        $locator = new PimpleHandlerLocator($container->reveal());
        $result = $locator->getHandlerForCommand($commandName);

        $this->assertSame($handler, $result);
    }

    /**
     * @expectedException \League\Tactician\Exception\MissingHandlerException
     */
    public function testIsThrowingExceptionForNotFoundHandler()
    {
        $commandName = 'fake_command';
        $handlerId = 'app.command.fake_handler';

        $container = $this->prophesize(Container::class);
        $container->offsetGet($handlerId)->willThrow(new \InvalidArgumentException());

        $locator = new PimpleHandlerLocator($container->reveal());
        $locator->getHandlerForCommand($commandName);
    }
}
