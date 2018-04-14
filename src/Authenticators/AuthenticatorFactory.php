<?php

namespace Snaptier\Laravel\Authenticators;

use InvalidArgumentException;

/**
 * This is the authenticator factory class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class AuthenticatorFactory
{
    /**
     * Make a new authenticator instance.
     *
     * @param string $method
     *
     * @throws \InvalidArgumentException
     *
     * @return \Snaptier\Laravel\Authenticators\AuthenticatorInterface
     */
    public function make(string $method)
    {
        switch ($method) {
            case 'oauth':
                return new OauthAuthenticator(); // AUTH_OAUTH_TOKEN
            case 'password':
                return new PasswordAuthenticator(); // AUTH_HTTP_PASSWORD
        }

        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
