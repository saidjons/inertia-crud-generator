<?php

namespace Saidjon\InertiaCrudGenerator;

class InertiaCrudGenerator
{

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
