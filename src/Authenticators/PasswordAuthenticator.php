<?php

namespace Snaptier\Laravel\Authenticators;

use InvalidArgumentException;
use Snaptier\API\Client;

/**
 * This is the password authenticator class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class PasswordAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Snaptier\API\Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the password authenticator.');
        }

        if (!array_key_exists('username', $config) || !array_key_exists('password', $config)) {
            throw new InvalidArgumentException('The password authenticator requires a username and password.');
        }

        $this->client->authenticate(Client::AUTH_HTTP_PASSWORD, $config['username'], $config['password']);

        return $this->client;
    }
}
