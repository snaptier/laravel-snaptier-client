<?php

namespace Snaptier\Laravel\Tests\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Snaptier\Laravel\Facades\Snaptier;
use Snaptier\Laravel\SnaptierManager;
use Snaptier\Laravel\Tests\AbstractTestCase;

/**
 * This is the snaptier facade test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class SnaptierTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'snaptier';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Snaptier::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return SnaptierManager::class;
    }
}
