<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait CrudCreate {

//  public  $VUE_PATH="js/Pages/"; //with trailing slash
 

  public function generateVueCreate()
  {
    
        $generatedCreateFile = $this->generateTemplateFrom($this->replacements,'vue','Create');

           $message = $this->createFile($generatedCreateFile,$this->VUE_PATH,$this->replacements['folderName'],'Create.vue');
          $this->messages[] = $message;
           
           return $this;

  }
  
  
  
   


}