<?php namespace Powerplanetonline\LogViewer;

use Arcanedev\Support\PackageServiceProvider as ServiceProvider;

/**
 * Class     LogViewerServiceProvider
 *
 * @package  Powerplanetonline\LogViewer
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor  = 'powerplanetonline';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'log-viewer';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->app->register('Powerplanetonline\\LogViewer\\Providers\\UtilitiesServiceProvider');
        $this->registerLogViewer();
        $this->registerAliases();

        if ($this->app->runningInConsole()) {
            $this->app->register('Powerplanetonline\\LogViewer\\Providers\\CommandsServiceProvider');
        }
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishViews();
        $this->publishTranslations();
        $this->app->register('Powerplanetonline\\LogViewer\\Providers\\RouteServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.log-viewer',
            'Powerplanetonline\\LogViewer\\Contracts\\LogViewerInterface',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Services Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the log data class.
     */
    private function registerLogViewer()
    {
        $this->singleton(
            'arcanedev.log-viewer',
            'Powerplanetonline\\LogViewer\\LogViewer'
        );

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\LogViewerInterface',
            'arcanedev.log-viewer'
        );

        // Registering the Facade
        $this->alias(
            $this->app['config']->get('log-viewer.facade', 'LogViewer'),
            'Powerplanetonline\\LogViewer\\Facades\\LogViewer'
        );
    }
}
