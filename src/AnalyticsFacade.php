<?php

namespace JfelixStudio\Analytics;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JfelixStudio\Analytics\Analytics
 */
class AnalyticsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-analytics';
    }
}
