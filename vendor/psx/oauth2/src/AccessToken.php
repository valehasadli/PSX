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

namespace PSX\Oauth2;

use PSX\Record\Record;

/**
 * AccessToken
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class AccessToken extends Record
{
    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->setProperty('access_token', $accessToken);
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->getProperty('access_token');
    }

    /**
     * @param string $tokenType
     */
    public function setTokenType($tokenType)
    {
        $this->setProperty('token_type', $tokenType);
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->getProperty('token_type');
    }

    /**
     * @param integer $expiresIn
     * @deprecated
     */
    public function setExpires($expiresIn)
    {
        $this->setProperty('expires_in', (int) $expiresIn);
    }

    /**
     * @param integer $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->setProperty('expires_in', (int) $expiresIn);
    }

    /**
     * @return integer
     */
    public function getExpiresIn()
    {
        return $this->getProperty('expires_in');
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->setProperty('refresh_token', $refreshToken);
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->getProperty('refresh_token');
    }

    /**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->setProperty('scope', $scope);
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->getProperty('scope');
    }
}
