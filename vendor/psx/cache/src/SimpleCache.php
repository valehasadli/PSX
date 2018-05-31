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

namespace PSX\Cache;

use Doctrine\Common\Cache\CacheProvider;
use Psr\SimpleCache\CacheInterface;

/**
 * Simple cache implementation which uses the doctrine cache system
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class SimpleCache implements CacheInterface
{
    /**
     * @var \Doctrine\Common\Cache\CacheProvider
     */
    protected $handler;

    public function __construct(CacheProvider $handler)
    {
        $this->handler = $handler;
    }

    public function get($key, $default = null)
    {
        $value = $this->handler->fetch($key);

        return $value !== false ? $value : $default;
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->handler->save($key, $value, $ttl === null ? 0 : $ttl);
    }

    public function has($key)
    {
        return $this->handler->contains($key);
    }

    public function delete($key)
    {
        return $this->handler->delete($key);
    }

    public function clear()
    {
        return $this->handler->deleteAll();
    }

    public function getMultiple($keys, $default = null)
    {
        $keys   = $this->getAsArray($keys);
        $result = [];
        $data   = $this->handler->fetchMultiple($keys);

        foreach ($keys as $key) {
            if (isset($data[$key]) && $data[$key] !== false) {
                $result[$key] = $data[$key];
            } else {
                $result[$key] = $default;
            }
        }

        return $result;
    }

    public function setMultiple($values, $ttl = null)
    {
        return $this->handler->saveMultiple($this->getAsArray($values), $ttl);
    }

    public function deleteMultiple($keys)
    {
        $keys   = $this->getAsArray($keys);
        $result = true;

        foreach ($keys as $key) {
            $result = $this->handler->delete($key) && $result;
        }

        return $result;
    }

    private function getAsArray($keys)
    {
        if ($keys instanceof \Traversable) {
            return iterator_to_array($keys);
        } elseif (is_array($keys)) {
            return $keys;
        } else {
            throw new InvalidArgumentException('Value must be an array');
        }
    }
}
