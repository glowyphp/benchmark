<?php

declare(strict_types=1);

namespace Glowy\Benchmark;

use Glowy\Benchmark\Benchmark;

if (! function_exists('benchmarkStart')) {
    /**
     * Start benchmark prob.
     * 
     * @param string $name prob name
     */
    function benchmarkStart(string $name = 'default'): void
    {
        Benchmark::start($name);
    }
}

if (! function_exists('benchmarkEnd')) {
    /**
     * End benchmark prob.
     * 
     * @param string $name prob name
     */
    function benchmarkEnd(string $name = 'default'): void
    {
        Benchmark::end($name);
    }
}

if (! function_exists('benchmarkSummary')) {
    /** 
     * Get benchmark summary.
     * 
     * @return array
     */
    function benchmarkSummary(): array
    {
        return Benchmark::summary();
    }
}