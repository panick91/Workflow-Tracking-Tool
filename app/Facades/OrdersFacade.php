<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 13.09.2015
 * Time: 12:41
 */

namespace WTT\Facades;

use Illuminate\Support\Facades\Facade;

class OrdersFacade extends Facade
{
    /**
     * Get the registered name of the component. This tells $this->app what record to return
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'OrdersService'; }
}