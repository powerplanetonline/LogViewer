<?php namespace Powerplanetonline\LogViewer\Contracts;

use \Illuminate\Contracts\Config\Repository as Config;

/**
 * Interface  LogCheckerInterface
 *
 * @package   Powerplanetonline\LogViewer\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface LogCheckerInterface
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
    public function setConfig(Config $config);

    /**
     * Set the Filesystem instance.
     *
     * @param  \Powerplanetonline\LogViewer\Contracts\FilesystemInterface  $filesystem
     *
     * @return self
     */
    public function setFilesystem(FilesystemInterface $filesystem);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get messages.
     *
     * @return array
     */
    public function messages();

    /**
     * Check passes ??
     *
     * @return bool
     */
    public function passes();

    /**
     * Check fails ??
     *
     * @return bool
     */
    public function fails();

    /**
     * Get the requirements
     *
     * @return array
     */
    public function requirements();
}
