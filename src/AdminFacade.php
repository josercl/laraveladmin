<?php

namespace Josercl\Admin;

use Illuminate\Support\Facades\Facade;

class AdminFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Admin';
    }
}
