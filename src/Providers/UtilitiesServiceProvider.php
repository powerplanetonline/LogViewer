<?php namespace Powerplanetonline\LogViewer\Providers;

use Powerplanetonline\LogViewer\Utilities\Filesystem;
use Powerplanetonline\LogViewer\Utilities\LogLevels;
use Arcanedev\Support\ServiceProvider;

/**
 * Class     UtilitiesServiceProvider
 *
 * @package  Powerplanetonline\LogViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UtilitiesServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerLogLevels();
        $this->registerStyler();
        $this->registerLogMenu();
        $this->registerFilesystem();
        $this->registerFactory();
        $this->registerChecker();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.log-viewer.levels',
            'Powerplanetonline\\LogViewer\\Contracts\\LogLevelsInterface',
            'arcanedev.log-viewer.styler',
            'Powerplanetonline\\LogViewer\\Contracts\\LogStylerInterface',
            'arcanedev.log-viewer.menu',
            'Powerplanetonline\\LogViewer\\Contracts\\LogMenuInterface',
            'arcanedev.log-viewer.filesystem',
            'Powerplanetonline\\LogViewer\\Contracts\\FilesystemInterface',
            'arcanedev.log-viewer.factory',
            'Powerplanetonline\\LogViewer\\Contracts\\FactoryInterface',
            'arcanedev.log-viewer.checker',
            'Powerplanetonline\\LogViewer\\Contracts\\LogCheckerInterface',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  The LogViewer Utilities
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the log levels.
     */
    private function registerLogLevels()
    {
        $this->singleton('arcanedev.log-viewer.levels', function ($app) {
            /**
             * @var  \Illuminate\Config\Repository       $config
             * @var  \Illuminate\Translation\Translator  $translator
             */
            $config     = $app['config'];
            $translator = $app['translator'];

            return new LogLevels($translator, $config->get('log-viewer.locale'));
        });

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\LogLevelsInterface',
            'arcanedev.log-viewer.levels'
        );
    }

    /**
     * Register the log styler.
     */
    private function registerStyler()
    {
        $this->singleton(
            'arcanedev.log-viewer.styler',
            'Powerplanetonline\\LogViewer\\Utilities\\LogStyler'
        );

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\LogStylerInterface',
            'arcanedev.log-viewer.styler'
        );
    }

    /**
     * Register the log menu builder.
     */
    private function registerLogMenu()
    {
        $this->singleton(
            'arcanedev.log-viewer.menu',
            'Powerplanetonline\\LogViewer\\Utilities\\LogMenu'
        );

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\LogMenuInterface',
            'arcanedev.log-viewer.menu'
        );
    }

    /**
     * Register the log filesystem.
     */
    private function registerFilesystem()
    {
        $this->singleton('arcanedev.log-viewer.filesystem', function ($app) {
            /**
             * @var  \Illuminate\Config\Repository      $config
             * @var  \Illuminate\Filesystem\Filesystem  $files
             */
            $config     = $app['config'];
            $files      = $app['files'];
            $filesystem = new Filesystem($files, $config->get('log-viewer.storage-path'));

            $filesystem->setPattern(
                $config->get('log-viewer.pattern.prefix',    Filesystem::PATTERN_PREFIX),
                $config->get('log-viewer.pattern.date',      Filesystem::PATTERN_DATE),
                $config->get('log-viewer.pattern.extension', Filesystem::PATTERN_EXTENSION)
            );

            return $filesystem;
        });

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\FilesystemInterface',
            'arcanedev.log-viewer.filesystem'
        );
    }

    /**
     * Register the log factory class.
     */
    private function registerFactory()
    {
        $this->singleton(
            'arcanedev.log-viewer.factory',
            'Powerplanetonline\\LogViewer\\Utilities\\Factory'
        );

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\FactoryInterface',
            'arcanedev.log-viewer.factory'
        );
    }

    /**
     * Register the log checker service.
     */
    private function registerChecker()
    {
        $this->singleton(
            'arcanedev.log-viewer.checker',
            'Powerplanetonline\LogViewer\Utilities\LogChecker'
        );

        $this->bind(
            'Powerplanetonline\\LogViewer\\Contracts\\LogCheckerInterface',
            'arcanedev.log-viewer.checker'
        );
    }
}
