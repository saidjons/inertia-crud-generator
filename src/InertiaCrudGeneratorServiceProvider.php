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

    public function boot()
    {
           $this->publishes([
            __DIR__.'../resources/Components' => resource_path('js/Components'),
            __DIR__.'../resources/Pages' => resource_path('js/Pages'),
            __DIR__.'../resources/plugins' => resource_path('js/plugins'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }
}
