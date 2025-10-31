<?php

namespace JoseVasquezRamos\PackTest;

use JoseVasquezRamos\PackTest\Commands\PackTestCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PackTestServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
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
                base_path('vendor/spatie/laravel-permission/config/permission.php') => config_path('permission.php'),
                base_path('vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub') => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_permission_tables.php'),
                base_path('vendor/spatie/laravel-permission/database/migrations/add_teams_fields.php.stub') => database_path('migrations/'.date('Y_m_d_His', time() + 2).'_add_teams_fields.php'),
                __DIR__.'/../database/migrations/add_columns_to_users_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_add_columns_to_users_table.php'),
            ], 'pack-test-publish-dependencies');

            
            $sanctumMigration = glob(base_path('vendor/laravel/sanctum/database/migrations/*_create_personal_access_tokens_table.php'));
            if (!empty($sanctumMigration)) {
                $this->publishes([
                    $sanctumMigration[0] => database_path('migrations/' . date('Y_m_d_His', time() + 3) . '_create_personal_access_tokens_table.php'),
                ], 'pack-test-publish-dependencies');
            }
        }
    }
}