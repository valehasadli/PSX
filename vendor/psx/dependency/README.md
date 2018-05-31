PSX Dependency
===

## About

A simple and fast PSR-11 compatible DI container. Besides the DI container it
provides a class which can resolve objects containing `@Inject` annotations 
using the doctrine annotation reader.

## Usage

### Container

It is possible to extend the `Container` class. All `getXXX` methods are service 
definitions which can be accessed if a new container is created.

```php
<?php

class MyContainer extends \PSX\Dependency\Container
{
    public function getFooService()
    {
        return new FooService();
    }
    
    public function getBarService()
    {
        return new BarService($this->get('foo_service'));
    }
} 

```

Also it is also possible to set services on a container in the "Pimple" way. 
Through this you can easily extend or overwrite existing containers.

```php
<?php

use Psr\Container\ContainerInterface;

$container = new \PSX\Dependency\Container();

$container->set('foo_service', function(ContainerInterface $c){
    return new FooService();
});

$container->set('bar_service', function(ContainerInterface $c){
    return new BarService($c->get('foo_service'));
});

```

### Object builder

The object builder resolves properties with an `@Inject` annotation and tries
to inject the fitting service to the property. If no explicit service name was 
provided the property name is used. Note usually it is recommended to use simple
constructor injection, this class is designed for cases where this is not 
feasible.

```php
<?php

class MyController
{
    /**
     * @Inject 
     */
    protected $fooService;

    /**
     * @Inject("bar_service")
     */
    protected $baz;

    public function doSomething()
    {
        $this->fooService->power();
    }
}

```

The object builder needs a doctrine annotation reader and cache instance. All
defined services are cached in production so that we only parse the annotations
once.

```php
<?php

$container = new MyContainer();
$reader = new \Doctrine\Common\Annotations\SimpleAnnotationReader();
$reader->addNamespace('PSX\Dependency\Annotation');
$cache = new \PSX\Cache\Pool(new \Doctrine\Common\Cache\ArrayCache());
$debug = false;

$builder = new \PSX\Dependency\ObjectBuilder(
    $container,
    $reader,
    $cache,
    $debug
);

$controller = $builder->getObject(MyController::class);

```

