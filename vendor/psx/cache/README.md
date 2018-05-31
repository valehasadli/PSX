PSX Cache
===

## About

[PSR-6](http://www.php-fig.org/psr/psr-6/) and [PSR-16](http://www.php-fig.org/psr/psr-16/) 
implementation using the doctrine cache system. 

## Usage

### PSR-6

```php
<?php

$pool = new PSX\Cache\Pool(new Doctrine\Common\Cache\FilesystemCache());
$item = $pool->getItem('foo');

if (!$item->isHit()) {
    $value = doComplexTask();

    $item->set($value);
    $item->expiresAfter(3600);

    $pool->save($item);
} else {
    $value = $item->get();
}
```

### PSR-16

```php
<?php

$cache = new PSX\Cache\SimpleCache(new Doctrine\Common\Cache\FilesystemCache());
$value = $cache->get('foo');

if ($value === null) {
    $value = doComplexTask();

    $cache->set('foo', $value, 3600);
}
```
