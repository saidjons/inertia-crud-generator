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
     
    
     

      
    public function generateController($replacements):string
    {
           $ctl=$this->getStub("/../stubs/controller/controller");
        $ctl= $this->replace($ctl,$replacements);
        
 
        return $ctl;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }
      public function fileWriterController($replacements,$template,$path,$fileNameWithExt)
    {
        
        if (!File::exists(base_path('app/Http/Controllers/Admin'))) {

          File::makeDirectory(base_path('app/Http/Controllers/Admin'), 0777, true, true);

        }
        if (!$this->filesystem->exists(base_path($path.$fileNameWithExt))) {

                $this->filesystem->put(base_path($path.'Admin/'.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);
                return ['message'=> 'Controller file created'];
            }else{
                return ['message'=> 'Controller exist . Not Created'];

            }
       
    }


}