<?php namespace Powerplanetonline\LogViewer\Utilities;

use Powerplanetonline\LogViewer\Contracts\LogMenuInterface;
use Powerplanetonline\LogViewer\Contracts\LogStylerInterface;
use Powerplanetonline\LogViewer\Entities\Log;
use Illuminate\Contracts\Config\Repository;

/**
 * Class     LogMenu
 *
 * @package  Powerplanetonline\LogViewer\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogMenu implements LogMenuInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The config repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The log styler instance.
     *
     * @var \Powerplanetonline\LogViewer\Contracts\LogStylerInterface
     */
    private $styler;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create the LogMenu instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository            $config
     * @param  \Powerplanetonline\LogViewer\Contracts\LogStylerInterface  $styler
     */
    public function __construct(Repository $config, LogStylerInterface $styler)
    {
        $this->setConfig($config);
        $this->setLogStyler($styler);
    }

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
    public function setConfig(Repository $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Set the log styler instance.
     *
     * @param  \Powerplanetonline\LogViewer\Contracts\LogStylerInterface  $styler
     *
     * @return self
     */
    public function setLogStyler(LogStylerInterface $styler)
    {
        $this->styler = $styler;

        return $this;
    }

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
    public function make(Log $log, $trans = true)
    {
        $items = [];
        $route = $this->config('menu.filter-route');

        foreach($log->tree($trans) as $level => $item) {
            $items[$level] = array_merge($item, [
                'url'  => route($route, [$log->date, $level]),
                'icon' => $this->isIconsEnabled() ? $this->styler->icon($level) : '',
            ]);
        }

        return $items;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the icons are enabled.
     *
     * @return bool
     */
    private function isIconsEnabled()
    {
        return (bool) $this->config('menu.icons-enabled', false);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function config($key, $default = null)
    {
        return $this->config->get('log-viewer.' . $key, $default);
    }
}
