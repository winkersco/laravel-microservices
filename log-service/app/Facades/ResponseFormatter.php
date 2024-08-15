<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'responseformatter';
    }
}
