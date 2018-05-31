PSX Validate
===

## About

Validation library which validates arbitrary data using a flexible filter
system.

## Usage

```php
<?php

use PSX\Validate\Filter;
use PSX\Validate\Validate;

$validate = new Validate();
$result   = $validate->validate($data, Validate::TYPE_STRING, [new Filter\Alnum(), new Filter\Length(3, 255)]);

if ($result->isSuccessful()) {
    echo 'Valid!';
} else {
    echo implode(', ', $result->getErrors());
}

```
