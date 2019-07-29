<?php

namespace ChrisBraybrooke\SendinBlueTracker\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class SendinBlueTracker extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sendin-blue.tracker';
    }
}