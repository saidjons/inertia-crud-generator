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
           __DIR__.'/../routes/' => base_path('routes/'),
        ]);


    
        // file_put_contents(base_path('routes/web.php'), "include_once('inertia-crud.php');".PHP_EOL , FILE_APPEND | LOCK_EX);

        // $this->loadRoutesFrom(__DIR__.'/../routes/inertia-crud.php');

    }
}
