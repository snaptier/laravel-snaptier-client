<?php

namespace Snaptier\Laravel\Tests;

use Snaptier\Laravel\SnaptierServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

/**
 * This is the abstract test case class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return SnaptierServiceProvider::class;
    }
}
