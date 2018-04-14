<?php

namespace Snaptier\Laravel\Tests;

use Snaptier\API\Client;
use Snaptier\Laravel\Authenticators\AuthenticatorFactory;
use Snaptier\Laravel\SnaptierFactory;
use Snaptier\Laravel\SnaptierManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testAuthFactoryIsInjectable()
    {
        $this->assertIsInjectable(AuthenticatorFactory::class);
    }

    public function testSnaptierFactoryIsInjectable()
    {
        $this->assertIsInjectable(SnaptierFactory::class);
    }

    public function testSnaptierManagerIsInjectable()
    {
        $this->assertIsInjectable(SnaptierManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['snaptier.connection'];
        $this->app['snaptier']->reconnect();
        $new = $this->app['snaptier.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
