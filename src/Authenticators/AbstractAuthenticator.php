<?php

namespace Snaptier\Laravel\Authenticators;

use Snaptier\API\Client;

/**
 * This is the abstract authenticator class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
abstract class AbstractAuthenticator
{
    /**
     * The client to perform the authentication on.
     *
     * @var \Snaptier\API\Client|null
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \Snaptier\API\Client $client
     *
     * @return \Snaptier\Laravel\Authenticators\AuthenticatorInterface
     */
    public function with(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
