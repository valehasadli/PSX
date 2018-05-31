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

use Psr\Cache\CacheItemInterface;

/**
 * Item
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class Item implements CacheItemInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var boolean
     */
    protected $isHit;

    /**
     * @var integer
     */
    protected $ttl;

    public function __construct($key, $value, $isHit, $ttl = 0)
    {
        $this->key   = $key;
        $this->value = $value;
        $this->isHit = $isHit;
        $this->ttl   = $ttl;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function get()
    {
        return $this->value;
    }

    public function isHit()
    {
        return $this->isHit;
    }

    public function set($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function expiresAt($expiration)
    {
        if (is_int($expiration)) {
            $this->ttl = $expiration - time();
        } elseif ($expiration instanceof \DateTime) {
            $this->ttl = $expiration->getTimestamp() - time();
        } elseif ($expiration === null) {
            $this->ttl = 0;
        } else {
            throw new Exception('Invalid expires at parameter');
        }

        return $this;
    }

    public function expiresAfter($time)
    {
        if (is_int($time)) {
            $this->ttl = $time;
        } elseif ($time instanceof \DateInterval) {
            $now = new \DateTime();
            $now->add($time);
            $this->ttl = $now->getTimestamp() - time();
        } elseif ($time === null) {
            $this->ttl = 0;
        } else {
            throw new Exception('Invalid expires after parameter');
        }

        return $this;
    }

    public function getTtl()
    {
        return $this->ttl;
    }
}
