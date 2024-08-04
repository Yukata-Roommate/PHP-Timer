<?php

namespace YukataRm\Timer;

use YukataRm\Timer\Interface\TimerInterface;

/**
 * Timer
 * 
 * @package YukataRm\Timer
 */
class Timer implements TimerInterface
{
    /*----------------------------------------*
     * Start
     *----------------------------------------*/

    /**
     * start timestamp
     *
     * @var float
     */
    private float $startTimestamp = 0;

    /**
     * set start timestamp
     *
     * @param float $timestamp
     * @return void
     */
    protected function setStartTimestamp(float $timestamp): void
    {
        $this->startTimestamp = $timestamp;
    }

    /**
     * start measuring
     *
     * @return static
     */
    public function start(): static
    {
        $this->setStartTimestamp($this->now());

        return $this;
    }

    /**
     * get start timestamp
     * 
     * @return float
     */
    public function startTimeStamp(): float
    {
        return $this->startTimestamp;
    }

    /**
     * get start date time
     * 
     * @param string|null $format
     * @return string
     */
    public function startDateTime(string $format = null): string
    {
        return $this->formatTimestamp($this->startTimeStamp(), $format);
    }

    /*----------------------------------------*
     * Stop
     *----------------------------------------*/

    /**
     * stop timestamp
     *
     * @var float
     */
    private float $stopTimestamp = 0;

    /**
     * set stop timestamp
     *
     * @param float $timestamp
     * @return void
     */
    protected function setStopTimestamp(float $timestamp): void
    {
        $this->stopTimestamp = $timestamp;
    }

    /**
     * stop measuring
     *
     * @return static
     */
    public function stop(): static
    {
        $stopTimestamp = $this->now();

        $this->setStopTimestamp($stopTimestamp);

        $this->setSplitTimestamp($stopTimestamp);

        $this->setLapSecond($stopTimestamp);

        return $this;
    }

    /**
     * get stop timestamp
     * 
     * @return float
     */
    public function stopTimeStamp(): float
    {
        return $this->stopTimestamp;
    }

    /**
     * get stop date time
     * 
     * @param string|null $format
     * @return string
     */
    public function stopDateTime(string $format = null): string
    {
        return $this->formatTimestamp($this->stopTimeStamp(), $format);
    }

    /*----------------------------------------*
     * Elapsed
     *----------------------------------------*/

    /**
     * get elapsed time in seconds
     * 
     * @return float
     */
    public function elapsedSeconds(): float
    {
        return $this->getElapsedSeconds($this->startTimeStamp(), $this->stopTimeStamp());
    }

    /**
     * get elapsed time in milliseconds
     * 
     * @return float
     */
    public function elapsedMilliseconds(): float
    {
        return $this->secondsToMilliseconds($this->elapsedSeconds());
    }

    /**
     * get elapsed time in minutes
     * 
     * @return float
     */
    public function elapsedMinutes(): float
    {
        return $this->secondsToMinutes($this->elapsedSeconds());
    }

    /**
     * get elapsed time in hours
     * 
     * @return float
     */
    public function elapsedHours(): float
    {
        return $this->secondsToHours($this->elapsedSeconds());
    }

    /*----------------------------------------*
     * Split
     *----------------------------------------*/

    /**
     * split timestamps
     *
     * @var array<int, float>
     */
    private array $splitTimestamps = [];

    /**
     * set split timestamp
     *
     * @param float $timestamp
     * @return void
     */
    protected function setSplitTimestamp(float $timestamp): void
    {
        $this->splitTimestamps[] = $timestamp;
    }

    /**
     * record split timec
     *
     * @return static
     */
    public function split(): static
    {
        $this->setSplitTimestamp($this->now());

        return $this;
    }

    /**
     * get split timestamps
     * 
     * @return array<int, float>
     */
    public function splitTimestamps(): array
    {
        return $this->splitTimestamps;
    }

    /**
     * get split elapsed seconds
     * 
     * @return array<int, float>
     */
    public function splitElapsedSeconds(): array
    {
        $splitElapsedSeconds = [];

        $startTimestamp = $this->startTimeStamp();
        $splitTimestamps = $this->splitTimestamps();

        for ($i = 0; $i < count($splitTimestamps); $i++) {
            $splitElapsedSeconds[$i] = $splitTimestamps[$i] - $startTimestamp;
        }

        return $splitElapsedSeconds;
    }

    /**
     * get split date times
     * 
     * @param string|null $format
     * @return array<int, string>
     */
    public function splitDateTimes(string $format = null): array
    {
        return array_map(fn ($timestamp) => $this->formatTimestamp($timestamp, $format), $this->splitTimestamps());
    }

    /*----------------------------------------*
     * Lap
     *----------------------------------------*/

    /**
     * lap seconds
     *
     * @var array<int, float>
     */
    private array $lapSeconds = [];

    /**
     * set lap timestamp
     *
     * @param float $timestamp
     * @return void
     */
    protected function setLapSecond(float $timestamp): void
    {
        $this->lapSeconds[] = match (empty($this->lapSeconds)) {
            true  => $this->getElapsedSeconds($this->startTimeStamp(), $timestamp),

            false => $this->getElapsedSeconds($this->lapSeconds[count($this->lapSeconds) - 1], $timestamp - $this->startTimeStamp()),
        };
    }

    /**
     * record lap time
     *
     * @return static
     */
    public function lap(): static
    {
        $this->setLapSecond($this->now());

        return $this;
    }

    /**
     * get lap seconds
     * 
     * @return array<int, float>
     */
    public function lapSeconds(): array
    {
        return $this->lapSeconds;
    }

    /**
     * get lap milliseconds
     * 
     * @return array<int, float>
     */
    public function lapMilliseconds(): array
    {
        return array_map(fn ($lapSecond) => $this->secondsToMilliseconds($lapSecond), $this->lapSeconds());
    }

    /**
     * get lap minutes
     * 
     * @return array<int, float>
     */
    public function lapMinutes(): array
    {
        return array_map(fn ($lapSecond) => $this->secondsToMinutes($lapSecond), $this->lapSeconds());
    }

    /**
     * get lap hours
     * 
     * @return array<int, float>
     */
    public function lapHours(): array
    {
        return array_map(fn ($lapSecond) => $this->secondsToHours($lapSecond), $this->lapSeconds());
    }

    /*----------------------------------------*
     * Format
     *----------------------------------------*/

    /**
     * format of timestamp
     *
     * @var string
     */
    protected string $format = "Y-m-d H:i:s";

    /**
     * format timestamp
     *
     * @param float $timestamp
     * @param string|null $format
     * @return string
     */
    protected function formatTimestamp(float $timestamp, string|null $format): string
    {
        if (is_null($format)) $format = $this->format;

        return date($format, $timestamp);
    }

    /*----------------------------------------*
     * Common
     *----------------------------------------*/

    /**
     * get current timestamp
     *
     * @return float
     */
    protected function now(): float
    {
        return microtime(true);
    }

    /**
     * get elapsed seconds
     *
     * @param float $from
     * @param float $to
     * @return float
     */
    protected function getElapsedSeconds(float $from, float $to): float
    {
        return $to - $from;
    }

    /**
     * get elapsed milliseconds
     * 
     * @param float $seconds
     * @return float
     */
    protected function secondsToMilliseconds(float $seconds): float
    {
        return $seconds * 1000;
    }

    /**
     * get elapsed minutes
     * 
     * @param float $seconds
     * @return float
     */
    protected function secondsToMinutes(float $seconds): float
    {
        return $seconds / 60;
    }

    /**
     * get elapsed hours
     * 
     * @param float $seconds
     * @return float
     */
    protected function secondsToHours(float $seconds): float
    {
        return $this->secondsToMinutes($seconds) / 60;
    }
}
