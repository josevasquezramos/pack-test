<?php

namespace JoseVasquezRamos\PackTest;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use JoseVasquezRamos\PackTest\Commands\PackTestCommand;

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
            ->hasMigration('create_pack_test_table')
            ->hasCommand(PackTestCommand::class);
    }
}
