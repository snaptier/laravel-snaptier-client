<?php

namespace Snaptier\Laravel;

use Http\Client\Common\Plugin\RetryPlugin;
use Illuminate\Contracts\Cache\Factory;
use InvalidArgumentException;
use Madewithlove\IlluminatePsrCacheBridge\Laravel\CacheItemPool;
use Snaptier\API\Client;
use Snaptier\API\HttpClient\Builder;
use Snaptier\Laravel\Authenticators\AuthenticatorFactory;

/**
 * This is the snaptier factory class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierFactory
{
    /**
     * The authenticator factory instance.
     *
     * @var \Snaptier\Laravel\Authenticators\AuthenticatorFactory
     */
    protected $auth;

    /**
     * The illuminate cache instance.
     *
     * @var \Illuminate\Contracts\Cache\Factory|null
     */
    protected $cache;

    /**
     * Create a new snaptier factory instance.
     *
     * @param \Snaptier\Laravel\Authenticators\AuthenticatorFactory $auth
     * @param \Illuminate\Contracts\Cache\Factory|null              $cache
     *
     * @return void
     */
    public function __construct(AuthenticatorFactory $auth, Factory $cache = null)
    {
        $this->auth = $auth;
        $this->cache = $cache;
    }

    /**
     * Make a new snaptier client.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Snaptier\API\Client
     */
    public function make(array $config)
    {
        $client = new Client($this->getBuilder($config));

        if (!array_key_exists('method', $config)) {
            throw new InvalidArgumentException('The snaptier factory requires an auth method.');
        }

        if ($url = array_get($config, 'url')) {
            $client->setUrl($url);
        }

        if ($config['method'] === 'none') {
            return $client;
        }

        return $this->auth->make($config['method'])->with($client)->authenticate($config);
    }

    /**
     * Get the http client builder.
     *
     * @param string[] $config
     *
     * @return \Snaptier\API\HttpClient\Builder
     */
    protected function getBuilder(array $config)
    {
        $builder = new Builder();

        if ($backoff = array_get($config, 'backoff')) {
            $builder->addPlugin(new RetryPlugin(['retries' => $backoff === true ? 2 : $backoff]));
        }

        if ($this->cache && class_exists(CacheItemPool::class) && $cache = array_get($config, 'cache')) {
            $builder->addCache(new CacheItemPool($this->cache->store($cache === true ? null : $cache)));
        }

        return $builder;
    }
}
