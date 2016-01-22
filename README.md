# Tactician Pimple Service Provider

[![Build Status](https://travis-ci.org/ferodss/tactician-pimple-service-provider.svg?branch=master)](https://travis-ci.org/ferodss/tactician-pimple-service-provider)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/ferodss/tactician-pimple-service-provider#licence)

Provides [Tactician](https://github.com/thephpleague/tactician/) as service to 
[Pimple](https://github.com/silexphp/Pimple) container.

Basesd on [Atriedes Silex service provider](https://github.com/Atriedes/tactician-service-provider) and 
[official tactician bundle](https://github.com/thephpleague/tactician-bundle)

## Requirements

* PHP >= 5.6
* Pimple >= 3.0
* Tactician >= 1.0

## Installation

`composer require ferodss/tactician-pimple-service-provider`

## Usage

#### Register Tactician service provider

```php
$container->register(new TacticianServiceProvider());
```

#### Middlewares

By default, the only Middleware enabled is the Command Handler support which will be automatically pushed to 
the end of middlewares array.

You can add your own middlewares using `tactician.middlewares` option.

```php
$container->register(new TacticianServiceProvider(), [
    'tactician.middlewares' => [
        $container['tactician.middleware.locking'],
    ],
]);
```

As Tactician provides only `LockingMiddleware` built in, there is just `tactician.middleware.locking` registered 
  and ready to use on container.


#### Handler method

Handler method inflector is registered as `tactician.inflector` option. Available options are 
`class_name`, `class_name_without_suffix`, `invoke` or `handle`. Default to `handle`

See more about [inflectors](https://tactician.thephpleague.com/tweaking-tactician/)

#### Configuring command handlers

A command handle MUST be registered as `app.command.<command name descamelized>_handler`, so if you have a command 
called `RegisterUserCommand` you probably have a `RegisterUserHandler` which must be registered as 
`app.command.register_user_handler`

Licence
=======

Copyright (c) 2016 Felipe Rodrigues

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
