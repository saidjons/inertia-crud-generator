<?php 

namespace Saidjon\InertiaCrudGenerator;

use Illuminate\Support\Str;

trait CrudController {

 public  $CTL_PATH="app/Http/Controllers/Admin/"; //with trailing slash

  
    public function makeControllerName()
    {
        
        return ucfirst($this->model_name).'CrudController';
    }
     
    
     

      
    public function generateController($replacements):string
    {
           $ctl=$this->getStub("controller/controller");
        $ctl= $this->replace($ctl,$replacements);
        
 
        return $ctl;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }
      public function fileWriterController($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        // if (!$this->filesystem->exists(base_path($PATH.$replacements['folderName']))) {

        //     $this->filesystem->makeDirectory(base_path($PATH).$replacements["folderName"],0755);

        // }
        if (!$this->filesystem->exists(base_path($PATH.$fileNameWithExt))) {

                $this->filesystem->put(base_path($PATH.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);
                return ['message'=> 'Controller file created'];
            }else{
                return ['message'=> 'Controller exist . Not Created'];

            }
       
    }


}