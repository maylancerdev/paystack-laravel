<?php

namespace Maylancer\Paystack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Maylancer\Paystack\Paystack
 */
class Paystack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Maylancer\Paystack\Paystack::class;
    }
}
