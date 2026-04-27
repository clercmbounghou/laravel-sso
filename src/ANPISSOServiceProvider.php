<?php

namespace AnpiGabon\SSO;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class ANPISSOServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/anpi-sso.php', 'anpi-sso');
    }

    public function boot(): void
    {
        $this->registerSocialiteDriver();
        $this->registerPublishables();
    }

    private function registerSocialiteDriver(): void
    {
        Socialite::extend('anpi', function () {
            $config = config('services.anpi');

            return Socialite::buildProvider(ANPIProvider::class, $config);
        });
    }

    private function registerPublishables(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        // php artisan vendor:publish --tag=anpi-sso-config
        $this->publishes([
            __DIR__ . '/../config/anpi-sso.php' => config_path('anpi-sso.php'),
        ], 'anpi-sso-config');

        // php artisan vendor:publish --tag=anpi-sso-migration
        $this->publishes([
            __DIR__ . '/../database/migrations/add_anpi_sso_to_users_table.php.stub'
                => database_path('migrations/' . date('Y_m_d_His') . '_add_anpi_sso_to_users_table.php'),
        ], 'anpi-sso-migration');

        // php artisan vendor:publish --tag=anpi-sso-views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/anpi-sso'),
        ], 'anpi-sso-views');

        // php artisan vendor:publish --tag=anpi-sso-controller
        $this->publishes([
            __DIR__ . '/../stubs/ANPIAuthController.stub'
                => app_path('Http/Controllers/Auth/ANPIAuthController.php'),
        ], 'anpi-sso-controller');

        // php artisan vendor:publish --tag=anpi-sso-routes
        $this->publishes([
            __DIR__ . '/../routes/anpi.php' => base_path('routes/anpi.php'),
        ], 'anpi-sso-routes');

        // Tout publier d'un coup : php artisan vendor:publish --tag=anpi-sso
        $this->publishes([
            __DIR__ . '/../config/anpi-sso.php'                          => config_path('anpi-sso.php'),
            __DIR__ . '/../resources/views'                              => resource_path('views/vendor/anpi-sso'),
            __DIR__ . '/../stubs/ANPIAuthController.stub'                => app_path('Http/Controllers/Auth/ANPIAuthController.php'),
            __DIR__ . '/../routes/anpi.php'                              => base_path('routes/anpi.php'),
        ], 'anpi-sso');
    }
}
