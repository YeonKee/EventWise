<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SessionManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sessionmanager';
    }
}