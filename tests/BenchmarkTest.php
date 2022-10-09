<?php

declare(strict_types=1);

use function Glowy\Benchmark\benchmarkStart;
use function Glowy\Benchmark\benchmarkEnd;
use function Glowy\Benchmark\benchmarkSummary;
use function Glowy\Benchmark\benchmarkFlush;
use function Glowy\Benchmark\benchmarkDelete;

test('test benchmark helpers', function (): void {

    // start, end, summary
    benchmarkStart('foo');
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

    // flush
    benchmarkFlush();
    expect(benchmarkSummary())->toHaveCount(0);

    // delete
    benchmarkStart('bar');
    benchmarkStart('fed');
    benchmarkEnd('fed');
    benchmarkEnd('bar');

    benchmarkDelete('bar');

    expect(benchmarkSummary())->toHaveCount(1);
});
