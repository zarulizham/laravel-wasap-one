<?php

namespace ZarulIzham\WasapOne\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ZarulIzham\WasapOne\WasapOne
 */
class WasapOne extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ZarulIzham\WasapOne\WasapOne::class;
    }
}
