<?php

namespace YukataRm\Laravel\Timer\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Timer Facade
 * 
 * @package YukataRm\Laravel\Timer\Facade
 * 
 * @method static \YukataRm\Laravel\Timer\Interface\TimerInterface make()
 * @method static \YukataRm\Laravel\Timer\Interface\TimerInterface start()
 * 
 * @see \YukataRm\Laravel\Timer\Facade\Manager
 */
class Timer extends Facade
{
    /** 
     * Facade Accessor
     * 
     * @return string 
     */
    protected static function getFacadeAccessor(): string
    {
        return static::class;
    }
}
