<?php

namespace JoseVasquezRamos\PackTest;

use JoseVasquezRamos\PackTest\Commands\PackTestCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PackTestServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pack-test')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                'create_companies_table',
                'create_departments_table',
                'create_user_profiles_table',
            ])
            ->hasCommand(PackTestCommand::class);

        $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
    }

    public function boot()
    {
        parent::boot();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/add_columns_to_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_add_columns_to_users_table.php'),
            ], 'pack-test-migrations');
            $this->publishes([
                __DIR__ . '/../vendor/spatie/laravel-permission/config/permission.php' => config_path('permission.php'),
                __DIR__ . '/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 1) . '_create_permission_tables.php'),
                __DIR__ . '/../vendor/laravel/sanctum/database/migrations/create_personal_access_tokens_table.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 2) . '_create_personal_access_tokens_table.php'),
            ], 'pack-test-dependencies');
        }
    }
}
