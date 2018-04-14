<?php

namespace Snaptier\Laravel\Tests;

use GrahamCampbell\Analyzer\AnalysisTrait;
use Laravel\Lumen\Application;
use PHPUnit\Framework\TestCase;

/**
 * This is the analysis test class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class AnalysisTest extends TestCase
{
    use AnalysisTrait;

    /**
     * Get the code paths to analyze.
     *
     * @return string[]
     */
    protected function getPaths()
    {
        return [
            realpath(__DIR__.'/../config'),
            realpath(__DIR__.'/../src'),
            realpath(__DIR__),
        ];
    }

    /**
     * Get the classes to ignore not existing.
     *
     * @return string[]
     */
    protected function getIgnored()
    {
        return [Application::class];
    }
}
