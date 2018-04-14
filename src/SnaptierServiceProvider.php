<?php

namespace Snaptier\Laravel;

use Snaptier\API\Client;
use Snaptier\Laravel\Authenticators\AuthenticatorFactory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the snaptier service provider class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__.'/../config/snaptier.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('snaptier.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('snaptier');
        }

        $this->mergeConfigFrom($source, 'snaptier');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAuthFactory();
        $this->registerSnaptierFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the auth factory class.
     *
     * @return void
     */
    protected function registerAuthFactory()
    {
        $this->app->singleton('snaptier.authfactory', function () {
            return new AuthenticatorFactory();
        });

        $this->app->alias('snaptier.authfactory', AuthenticatorFactory::class);
    }

    /**
     * Register the snaptier factory class.
     *
     * @return void
     */
    protected function registerSnaptierFactory()
    {
        $this->app->singleton('snaptier.factory', function (Container $app) {
            $auth = $app['snaptier.authfactory'];
            $cache = $app['cache'];

            return new SnaptierFactory($auth, $cache);
        });

        $this->app->alias('snaptier.factory', SnaptierFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('snaptier', function (Container $app) {
            $config = $app['config'];
            $factory = $app['snaptier.factory'];

            return new SnaptierManager($config, $factory);
        });

        $this->app->alias('snaptier', SnaptierManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('snaptier.connection', function (Container $app) {
            $manager = $app['snaptier'];

            return $manager->connection();
        });

        $this->app->alias('snaptier.connection', Client::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'snaptier.authfactory',
            'snaptier.factory',
            'snaptier',
            'snaptier.connection',
        ];
    }
}
