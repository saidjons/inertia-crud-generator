<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait CrudEdit{
      public function generateEditVue($replacements):string
    {
           $createVue=$this->getStub("/../stubs/vue/Edit");
        $createVue= $this->replace($createVue,$replacements);
        
 
  return $createVue;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }

}