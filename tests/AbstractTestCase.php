<?php

namespace Snaptier\Laravel\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Snaptier\Laravel\SnaptierServiceProvider;

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
