<?php

namespace Snaptier\Laravel\Authenticators;

use Snaptier\API\Client;

/**
 * This is the authenticator interface.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
interface AuthenticatorInterface
{
    /**
     * Set the client to perform the authentication on.
     *
     * @param \Snaptier\API\Client $client
     *
     * @return \Snaptier\Laravel\Authenticators\AuthenticatorInterface
     */
    public function with(Client $client);

    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Snaptier\API\Client
     */
    public function authenticate(array $config);
}
