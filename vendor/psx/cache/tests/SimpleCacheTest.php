<?php
/*
 * PSX is an open source PHP framework to develop REST APIs.
 * For the current version and information visit <http://phpsx.org>
 *
 * Copyright 2010-2017 Christoph Kappestein <christoph.kappestein@gmail.com>
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

namespace PSX\Cache\Tests;

use Doctrine\Common\Cache\ArrayCache;
use PSX\Cache\SimpleCache;

/**
 * SimpleCacheTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class SimpleCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testCache()
    {
        $cache = $this->newSimpleCache();

        // remove any existing cache
        $cache->clear();

        // get an item which does not exist
        $value = $cache->get('key');

        $this->assertSame(null, $value);

        // create an item which does not expire
        $cache->set('key', 'foobar');

        $value = $cache->get('key');

        $this->assertEquals('foobar', $value);

        // check whether multiple load calls return the same result
        $value = $cache->get('key');

        $this->assertEquals('foobar', $value);

        // remove the item
        $cache->delete('key');

        $value = $cache->get('key');

        $this->assertSame(null, $value);
    }

    public function testCacheMultiple()
    {
        $cache = $this->newSimpleCache();

        // remove any existing cache
        $cache->clear();

        // get an item which does not exist
        $value = $cache->getMultiple(['key', 'foo']);

        $this->assertSame(['key' => null, 'foo' => null], $value);

        // create an item which does not expire
        $cache->setMultiple(['key' => 'foo', 'foo' => 'bar']);

        $value = $cache->getMultiple(['key', 'foo']);

        $this->assertSame(['key' => 'foo', 'foo' => 'bar'], $value);

        // check whether multiple load calls return the same result
        $value = $cache->getMultiple(['key', 'foo']);

        $this->assertSame(['key' => 'foo', 'foo' => 'bar'], $value);

        // remove the item
        $cache->deleteMultiple(['key', 'foo']);

        $value = $cache->getMultiple(['key', 'foo']);

        $this->assertSame(['key' => null, 'foo' => null], $value);
    }

    /**
     * @return \Psr\SimpleCache\CacheInterface
     */
    protected function newSimpleCache()
    {
        return new SimpleCache(new ArrayCache());
    }
}
