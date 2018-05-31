<?php

namespace App\Tests;

use App\Api\Population;
use PSX\Framework\Test\ControllerDbTestCase;

class ApiTestCase extends ControllerDbTestCase
{
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/api_fixture.xml');
    }

    protected function getPaths()
    {
        return array(
            [['ANY'], '/population', Population\Collection::class],
            [['ANY'], '/population/:id', Population\Entity::class],
        );
    }
}
