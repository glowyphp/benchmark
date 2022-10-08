<?php

declare(strict_types=1);

namespace Glowy\Benchmark;

class Benchmark
{
    /**
     * Probs
     *
     * @var array
     */
    protected static $probs = [];

    /**
     * Start benchmark prob.
     * 
     * @param string $name prob name
     */
    public static function start(string $name = 'default'): void
    {
        self::$probs[$name]['time']['prob_start'] = microtime(true);
        self::$probs[$name]['memory']['prob_start'] = memory_get_usage();
    }

    /**
     * End benchmark prob.
     * 
     * @param string $name prob name
     */
    public static function end(string $name = 'default'): void
    {
        self::$probs[$name]['time']['prob_end'] = microtime(true);
        self::$probs[$name]['time']['elapsed'] = microtime(true) - self::$probs[$name]['time']['prob_start'];
        
        $format = '%.3f%s';
        $round = 3;

        if (self::$probs[$name]['time']['elapsed'] >= 1) {
            $unit = 's';
            $time = round(self::$probs[$name]['time']['elapsed'], $round);
        } else {
            $unit = 'ms';
            $time = round(self::$probs[$name]['time']['elapsed'] * 1000);
            $format = preg_replace('/(%.[\d]+f)/', '%d', $format);
        }

        self::$probs[$name]['time']['elapsed_formated'] = sprintf($format, $time, $unit);

        self::$probs[$name]['memory']['prob_end'] = memory_get_usage();

        $unit = ['B', 'KB', 'MB', 'GB', 'TiB', 'PiB'];
        $size = self::$probs[$name]['memory']['prob_end'] - self::$probs[$name]['memory']['prob_start'];
        $memory_usage = @round($size/pow(1024, ($i=floor(log($size, 1024)))), 2) . $unit[($i < 0 ? 0 : $i)];
        
        self::$probs[$name]['memory']['usage'] = $size;
        self::$probs[$name]['memory']['usage_formated'] = $memory_usage;
    }

    /** 
     * Get benchmark summary.
     * 
     * @return array
     */
    public static function summary(): array
    {
        return self::$probs;
    }
}