<?php

namespace Snaptier\Laravel\Tests;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Snaptier\API\Client;
use Snaptier\Laravel\SnaptierFactory;
use Snaptier\Laravel\SnaptierManager;

/**
 * This is the snaptier manager test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['token' => 'your-token'];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('snaptier.default')->andReturn('main');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('main', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(SnaptierFactory::class);

        $manager = new SnaptierManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('snaptier.connections')->andReturn(['main' => $config]);

        $config['name'] = 'main';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
