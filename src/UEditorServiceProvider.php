<?php namespace Ender\UEditor;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class UEditorServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
        // $this->handleMigrations();
        $this->handleViews();
        $this->handleTranslations();
        $this->handleRoutes();
        $this->handleRecources();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Bind any implementations.

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/ueditor.php';

        $this->publishes([$configPath => config_path('ueditor.php')],'config');

        $this->mergeConfigFrom($configPath, 'ueditor');
    }

    private function handleTranslations() {

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'ueditor');

        $this->publishes([__DIR__.'/../lang' => base_path('/resources/lang/')]);
    }

    private function handleViews() {

        $this->loadViewsFrom(__DIR__.'/../views','ueditor');

        $this->publishes([__DIR__.'/../views' => base_path('resources/views/vendor/ueditor')],'view');
    }

    private function handleMigrations() {

        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')],'migration');
    }

    private function handleRoutes() {

        include __DIR__.'/../routes.php';
    }

    private function handleRecources(){

        $this->publishes([
            __DIR__ . '/../resources/public/dialogs/' => public_path('vendor/ueditor/dialogs','dialog'),
            __DIR__ . '/../resources/public/lang/' => public_path('vendor/ueditor/lang','lang'),
            __DIR__ . '/../resources/public/themes/' => public_path('vendor/ueditor/themes','theme'),
            __DIR__ . '/../resources/public/third-party/' => public_path('vendor/ueditor/third-party','third-party'),
            __DIR__ . '/../resources/public/ueditor.all.min.js' => public_path('vendor/ueditor/','js'),
            __DIR__ . '/../resources/public/ueditor.config.js' => public_path('vendor/ueditor/','js'),
            __DIR__ . '/../resources/public/ueditor.parse.min.js' => public_path('vendor/ueditor/','js'),
        ]);
    }
}
