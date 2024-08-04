<?php

namespace YukataRm\Timer\Proxy;

use YukataRm\StaticProxy\StaticProxy;

use YukataRm\Timer\Proxy\Manager;

/**
 * Timer Proxy
 * 
 * @package YukataRm\Timer\Proxy
 * 
 * @method static \YukataRm\Timer\Interface\TimerInterface make()
 * @method static \YukataRm\Timer\Interface\TimerInterface start()
 * 
 * @see \YukataRm\Timer\Proxy\Manager
 */
class Timer extends StaticProxy
{
    /** 
     * get class name calling dynamic method
     * 
     * @return string 
     */
    protected static function getCallableClassName(): string
    {
        return Manager::class;
    }
}
