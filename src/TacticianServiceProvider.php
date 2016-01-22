<?php

namespace Pimple\Tactician\Provider;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameInflector;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameWithoutSuffixInflector;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Pimple\Tactician\Provider\Handler\CommandNameExtractor\DecamelizeClassNameExtractor;
use Pimple\Tactician\Provider\Handler\PimpleHandlerLocator;

class TacticianServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container['tactician.middlewares'] = [];

        $container['tactician.middleware.locking'] = function () {
            return new LockingMiddleware();
        };

        $container['tactician.commandbus'] = function ($container) {
            switch ($container['tactician.inflector']) {
                case 'class_name':
                    $inflector = new HandleClassNameInflector();
                    break;

                case 'class_name_without_suffix':
                    $inflector = new HandleClassNameWithoutSuffixInflector();
                    break;

                case 'invoke':
                    $inflector = new InvokeInflector();
                    break;

                case 'handle':
                default:
                    $inflector = new HandleInflector();
                    break;
            }

            $handlerMiddleware = new CommandHandlerMiddleware(
                new DecamelizeClassNameExtractor(),
                new PimpleHandlerLocator($container),
                $inflector
            );

            $middlewares = $container['tactician.middlewares'];
            array_push($middlewares, $handlerMiddleware);

            return new CommandBus($middlewares);
        };
    }
}
