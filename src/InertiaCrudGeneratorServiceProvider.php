<?php

namespace Saidjon\InertiaCrudGenerator;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
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
            __DIR__.'/../resources/js/Components' => resource_path('js/Components'),
            __DIR__.'/../resources/js/Pages' => resource_path('js/Pages'),
            __DIR__.'/../resources/js/plugins' => resource_path('js/plugins'),
            __DIR__.'/../resources/js/Layouts' => resource_path('js/Layouts'),
            __DIR__.'/../resources/js/app' => resource_path('js'),
            __DIR__.'/../resources/js/app/.babelrc' => base_path(),
            __DIR__.'/../resources/css' => resource_path('css'),
           __DIR__.'/../routes' => base_path('routes'),
          __DIR__.'/../database/migrations' => base_path('database/migrations'),
        ],'inertia-crud');

        
        // $this->loadRoutesFrom(__DIR__.'/../routes/inertia-crud.php');

    }
}
