<?php

namespace Snaptier\Laravel\Authenticators;

use InvalidArgumentException;
use Snaptier\API\Client;

/**
 * This is the oauth authenticator class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class OauthAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface
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
            throw new InvalidArgumentException('The client instance was not given to the oauth authenticator.');
        }

        if (!array_key_exists('token', $config)) {
            throw new InvalidArgumentException('The oauth authenticator requires a token.');
        }

        $this->client->authenticate(Client::AUTH_OAUTH_TOKEN, $config['token']);

        return $this->client;
    }
}
