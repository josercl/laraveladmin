<?php

namespace App\Providers\Josercl\Admin;

use Illuminate\Support\Facades\Facade;

class AdminFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Admin';
    }
}
