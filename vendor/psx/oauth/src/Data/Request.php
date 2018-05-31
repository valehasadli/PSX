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

namespace PSX\Oauth\Data;

use PSX\Record\Record;

/**
 * Request
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class Request extends Record
{
    public function setConsumerKey($consumerKey)
    {
        $this->setProperty('oauth_consumer_key', $consumerKey);
    }
    
    public function getConsumerKey()
    {
        return $this->getProperty('oauth_consumer_key');
    }

    public function setToken($token)
    {
        $this->setProperty('oauth_token', $token);
    }
    
    public function getToken()
    {
        return $this->getProperty('oauth_token');
    }

    public function setSignatureMethod($signatureMethod)
    {
        switch ($signatureMethod) {
            case 'HMAC-SHA1':
            case 'RSA-SHA1':
            case 'PLAINTEXT':
                $this->setProperty('oauth_signature_method', $signatureMethod);
                break;

            default:
                throw new \InvalidArgumentException('Invalid signature method');
                break;
        }
    }

    public function getSignatureMethod()
    {
        return $this->getProperty('oauth_signature_method');
    }

    public function setSignature($signature)
    {
        $this->setProperty('oauth_signature', $signature);
    }

    public function getSignature()
    {
        return $this->getProperty('oauth_signature');
    }

    /**
     * @param integer $timestamp
     */
    public function setTimestamp($timestamp)
    {
        if (is_numeric($timestamp) && strlen($timestamp) == 10) {
            $this->setProperty('oauth_timestamp', $timestamp);
        } else {
            throw new \InvalidArgumentException('Invalid timestamp format');
        }
    }

    public function getTimestamp()
    {
        return $this->getProperty('oauth_timestamp');
    }

    public function setNonce($nonce)
    {
        $this->setProperty('oauth_nonce', $nonce);
    }

    public function getNonce()
    {
        return $this->getProperty('oauth_nonce');
    }

    public function setCallback($callback)
    {
        if ($callback == 'oob') {
            // callback was set "out of bound" ... we get the url later from the
            // consumer object
            $this->setProperty('oauth_callback', 'oob');
        } elseif (strlen($callback) >= 7 && strlen($callback) <= 256 && filter_var($callback, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
            $this->setProperty('oauth_callback', $callback);
        } else {
            throw new \InvalidArgumentException('Invalid callback format');
        }
    }

    public function getCallback()
    {
        return $this->getProperty('oauth_callback');
    }

    public function setVersion($version)
    {
        $this->setProperty('oauth_version', $version);
    }

    public function getVersion()
    {
        return $this->getProperty('oauth_version');
    }

    public function setVerifier($verifier)
    {
        if (strlen($verifier) >= 16 && strlen($verifier) <= 512) {
            $this->setProperty('oauth_verifier', $verifier);
        } else {
            throw new \InvalidArgumentException('Invalid verifier format');
        }
    }

    public function getVerifier()
    {
        return $this->getProperty('oauth_verifier');
    }
}
