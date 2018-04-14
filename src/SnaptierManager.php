<?php

namespace Snaptier\Laravel;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the snaptier manager class.
 *
 * @see \Snaptier\API\Client
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Snaptier\Laravel\SnaptierFactory
     */
    protected $factory;

    /**
     * Create a new snapier manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Snaptier\Laravel\SnaptierFactory       $factory
     *
     * @return void
     */
    public function __construct(Repository $config, SnaptierFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Snaptier\API\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'snaptier';
    }

    /**
     * Get the factory instance.
     *
     * @return \Snaptier\Laravel\SnaptierFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
