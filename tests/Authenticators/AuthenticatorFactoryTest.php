<?php

namespace Snaptier\Laravel\Tests\Authenticators;

use Snaptier\Laravel\Authenticators\AuthenticatorFactory;
use Snaptier\Laravel\Authenticators\OauthAuthenticator;
use Snaptier\Laravel\Authenticators\PasswordAuthenticator;
use Snaptier\Laravel\Tests\AbstractTestCase;

/**
 * This is the authenticator factory test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class AuthenticatorFactoryTest extends AbstractTestCase
{
    public function testMakeOauthAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make('oauth');

        $this->assertInstanceOf(OauthAuthenticator::class, $return);
    }

    public function testMakePasswordAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make('password');

        $this->assertInstanceOf(PasswordAuthenticator::class, $return);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [foo].
     */
    public function testMakeInvalidAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make('foo');
    }

    /**
     * @expectedException TypeError
     */
    public function testMakeNoAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make(null);
    }

    protected function getFactory()
    {
        return new AuthenticatorFactory();
    }
}
