<?php

namespace YukataRm\Timer\Proxy;

use YukataRm\Timer\Interface\TimerInterface;
use YukataRm\Timer\Timer;

/**
 * Proxy Manager
 * 
 * @package YukataRm\Timer\Proxy
 */
class Manager
{
    /**
     * make Timer instance
     *
     * @return \YukataRm\Timer\Interface\TimerInterface
     */
    public function make(): TimerInterface
    {
        return new Timer();
    }

    /**
     * start measuring time with Timer instance
     *
     * @return \YukataRm\Timer\Interface\TimerInterface
     */
    public function start(): TimerInterface
    {
        return $this->make()->start();
    }
}
