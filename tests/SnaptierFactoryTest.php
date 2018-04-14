<?php

namespace Snaptier\Laravel\Tests;

use Snaptier\API\Client;
use Snaptier\Laravel\Authenticators\AuthenticatorFactory;
use Snaptier\Laravel\SnaptierFactory;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use Mockery;

/**
 * This is the snaptier factory test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth']);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeStandardExplicitCache()
    {
        $factory = $this->getFactory();

        $factory[1]->shouldReceive('store')->once()->with(null)->andReturn(Mockery::mock(Repository::class));

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth', 'cache' => true]);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeStandardNamedCache()
    {
        $factory = $this->getFactory();

        $factory[1]->shouldReceive('store')->once()->with('foo')->andReturn(Mockery::mock(Repository::class));

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth', 'cache' => 'foo']);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeStandardNoCacheOrBackoff()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth', 'cache' => false, 'backoff' => false]);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeStandardExplicitBackoff()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth', 'backoff' => true]);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeStandardExplicitUrl()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'oauth', 'url' => 'https://api.example.com']);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testMakeNoneMethod()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['method' => 'none']);

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [bar].
     */
    public function testMakeInvalidMethod()
    {
        $factory = $this->getFactory();

        $factory[0]->make(['method' => 'bar']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The snaptier factory requires an auth method.
     */
    public function testMakeEmpty()
    {
        $factory = $this->getFactory();

        $factory[0]->make([]);
    }

    protected function getFactory()
    {
        $cache = Mockery::mock(Factory::class);

        return [new SnaptierFactory(new AuthenticatorFactory(), $cache), $cache];
    }
}
