<?php

namespace YukataRm\Laravel\Timer\Facade;

use YukataRm\Timer\Proxy\Manager as PHPTimerManager;

use YukataRm\Laravel\Timer\Interface\TimerInterface;
use YukataRm\Laravel\Timer\Timer;

/**
 * Facade Manager
 * 
 * @package YukataRm\Laravel\Timer\Facade
 */
class Manager extends PHPTimerManager
{
    /**
     * make Laravel Timer instance
     *
     * @return \YukataRm\Laravel\Timer\Interface\TimerInterface
     */
    public function make(): TimerInterface
    {
        return new Timer();
    }
}
