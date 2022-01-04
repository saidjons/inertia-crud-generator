<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;

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
        
        if (!$this->filesystem->exists(base_path($path.'Admin'))) {

            $this->filesystem->makeDirectory(base_path($path).'Admin',0755);

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