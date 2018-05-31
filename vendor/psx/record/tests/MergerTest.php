<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2018 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PSX\Record\Tests;

use PSX\Record\Merger;
use PSX\Record\Record;
use PSX\Record\RecordInterface;

/**
 * MergerTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class MergerTest extends \PHPUnit_Framework_TestCase
{
    public function testMerge()
    {
        $left   = Record::fromArray(['id' => 1, 'foo' => 'bar']);
        $right  = Record::fromArray(['foo' => 'foo']);
        $result = Merger::merge($left, $right);

        $this->assertInstanceOf(RecordInterface::class, $result);
        $this->assertEquals(['id' => 1, 'foo' => 'foo'], $result->getProperties());
    }
}
