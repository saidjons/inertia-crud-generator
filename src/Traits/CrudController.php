<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait CrudController {

 public  $CTL_PATH="app/Http/Controllers/Admin/"; //with trailing slash

  
    public function makeControllerName()
    {
        
        return ucfirst($this->model_name).'CrudController';
    }
      
    public function generateController():self
    {
        $generatedController = $this->generateTemplateFrom($this->replacements,'controller','controller');

          $message =  $this->createController($this->replacements,$generatedController,$this->CTL_PATH,$this->replacements['controllerName'].'.php');
          $this->messages[] = $message;
          return $this;
       
    }
      public function createController($replacements,$template,$path,$fileNameWithExt)
    {
        
        if (!File::exists(base_path($path))) {

          File::makeDirectory(base_path($path), 0777, true, true);

        }
        if (!$this->filesystem->exists(base_path($path.$fileNameWithExt))) {

                $this->filesystem->put(base_path($path.$fileNameWithExt),$template);
                return ['message'=> $fileNameWithExt .' file created'];
            }else{
                return ['message'=> $fileNameWithExt .' exist . Not Created'];

            }
       
    }


}