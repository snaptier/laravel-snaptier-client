<?php

namespace Snaptier\Laravel\Tests\Authenticators;

use Snaptier\API\Client;
use Snaptier\Laravel\Authenticators\OauthAuthenticator;
use Snaptier\Laravel\Tests\AbstractTestCase;
use Mockery;

/**
 * This is the oauth authenticator test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class OauthAuthenticatorTest extends AbstractTestCase
{
    public function testMakeWithMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()
            ->with('oauth_token', 'your-token');

        $return = $authenticator->with($client)->authenticate([
            'token'  => 'your-token',
            'method' => 'token',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    public function testMakeWithoutMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()
            ->with('oauth_token', 'your-token');

        $return = $authenticator->with($client)->authenticate([
            'token'  => 'your-token',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The oauth authenticator requires a token.
     */
    public function testMakeWithoutToken()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);

        $return = $authenticator->with($client)->authenticate([]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The client instance was not given to the oauth authenticator.
     */
    public function testMakeWithoutSettingClient()
    {
        $authenticator = $this->getAuthenticator();

        $return = $authenticator->authenticate([
            'token'  => 'your-token',
            'method' => 'token',
        ]);
    }

    protected function getAuthenticator()
    {
        return new OauthAuthenticator();
    }
}
