<?php namespace Powerplanetonline\LogViewer\Contracts;

use Powerplanetonline\LogViewer\Entities\Log;
use Illuminate\Contracts\Config\Repository;

/**
 * Interface  LogMenuInterface
 *
 * @package   Powerplanetonline\LogViewer\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface LogMenuInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the config instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     *
     * @return self
     */
    public function setConfig(Repository $config);

    /**
     * Set the log styler instance.
     *
     * @param  \Powerplanetonline\LogViewer\Contracts\LogStylerInterface  $styler
     *
     * @return self
     */
    public function setLogStyler(LogStylerInterface $styler);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make log menu.
     *
     * @param  \Powerplanetonline\LogViewer\Entities\Log  $log
     * @param  bool                               $trans
     *
     * @return array
     */
    public function make(Log $log, $trans = true);
}
