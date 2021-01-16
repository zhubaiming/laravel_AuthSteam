<?php

namespace John\Authenupms\Facades;

use Illuminate\Support\Facades\Facade;

class Authenupms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'authenupms';
    }
}
