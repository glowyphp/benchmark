<?php

declare(strict_types=1);

use function Glowy\Benchmark\benchmarkStart;
use function Glowy\Benchmark\benchmarkEnd;
use function Glowy\Benchmark\benchmarkSummary;

test('test benchmark helpers', function (): void {
    benchmarkStart('foo');
    sleep(1);
    benchmarkEnd('foo');
    
    $summary = benchmarkSummary();

    expect($summary)->toBeArray();
    expect($summary)->toHaveKey('foo');
    expect($summary)->toHaveKey('foo.time');
    expect($summary)->toHaveKey('foo.time.prob_start');
    expect($summary)->toHaveKey('foo.time.prob_end');
    expect($summary)->toHaveKey('foo.time.elapsed');
    expect($summary)->toHaveKey('foo.time.elapsed_formated');
    expect($summary)->toHaveKey('foo.memory.prob_start');
    expect($summary)->toHaveKey('foo.memory.prob_end');
    expect($summary)->toHaveKey('foo.memory.usage');
    expect($summary)->toHaveKey('foo.memory.usage_formated');
});
