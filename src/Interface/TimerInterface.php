<?php

namespace YukataRm\Timer\Interface;

/**
 * Timer Interface
 * 
 * @package YukataRm\Timer\Interface
 */
interface TimerInterface
{
    /*----------------------------------------*
     * Start
     *----------------------------------------*/

    /**
     * start measuring
     *
     * @return static
     */
    public function start(): static;

    /**
     * get the start timestamp
     * 
     * @return float
     */
    public function startTimeStamp(): float;

    /**
     * get the start date time
     * 
     * @param string|null $format
     * @return string
     */
    public function startDateTime(string $format = null): string;

    /*----------------------------------------*
     * Stop
     *----------------------------------------*/

    /**
     * stop measuring
     *
     * @return static
     */
    public function stop(): static;

    /**
     * get the stop timestamp
     * 
     * @return float
     */
    public function stopTimeStamp(): float;

    /**
     * get the stop date time
     * 
     * @param string|null $format
     * @return string
     */
    public function stopDateTime(string $format = null): string;

    /*----------------------------------------*
     * Elapsed
     *----------------------------------------*/

    /**
     * get elapsed time in seconds
     * 
     * @return float
     */
    public function elapsedSeconds(): float;

    /**
     * get elapsed time in milliseconds
     * 
     * @return float
     */
    public function elapsedMilliseconds(): float;

    /**
     * get elapsed time in minutes
     * 
     * @return float
     */
    public function elapsedMinutes(): float;

    /**
     * get elapsed time in hours
     * 
     * @return float
     */
    public function elapsedHours(): float;

    /*----------------------------------------*
     * Split
     *----------------------------------------*/

    /**
     * record split time
     *
     * @return static
     */
    public function split(): static;

    /**
     * get split timestamps
     * 
     * @return array<int, float>
     */
    public function splitTimestamps(): array;

    /**
     * get split elapsed seconds
     * 
     * @return array<int, float>
     */
    public function splitElapsedSeconds(): array;

    /**
     * get split date times
     * 
     * @param string|null $format
     * @return array<int, string>
     */
    public function splitDateTimes(string $format = null): array;

    /*----------------------------------------*
     * Lap
     *----------------------------------------*/

    /**
     * record lap time
     *
     * @return static
     */
    public function lap(): static;

    /**
     * get lap seconds
     * 
     * @return array<int, float>
     */
    public function lapSeconds(): array;

    /**
     * get lap milliseconds
     * 
     * @return array<int, float>
     */
    public function lapMilliseconds(): array;

    /**
     * get lap minutes
     * 
     * @return array<int, float>
     */
    public function lapMinutes(): array;

    /**
     * get lap hours
     * 
     * @return array<int, float>
     */
    public function lapHours(): array;
}
