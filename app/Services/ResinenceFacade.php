<?php
namespace App\Services;

use Illuminate\Support\Facades\Facade;

class ResinenceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Resinence::class;
    }
}