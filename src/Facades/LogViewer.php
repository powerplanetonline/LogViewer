<?php namespace Powerplanetonline\LogViewer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class     LogViewer
 *
 * @package  Powerplanetonline\LogViewer\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.log-viewer'; }
}
