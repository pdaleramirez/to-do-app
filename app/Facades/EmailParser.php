<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class EmailParser extends Facade
{
    protected static function getFacadeAccessor() { return 'emailParser'; }
}