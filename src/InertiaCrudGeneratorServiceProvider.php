<?php

namespace Saidjon\InertiaCrudGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Saidjon\InertiaCrudGenerator\Commands\InertiaCrudGeneratorCommand;

class InertiaCrudGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('inertia-crud-generator')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_inertia-crud-generator_table')
            ->hasCommand(InertiaCrudGeneratorCommand::class);
    }
}
