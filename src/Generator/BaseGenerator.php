<?php

namespace Saidjon\InertiaCrudGenerator\Generator;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Saidjon\InertiaCrudGenerator\Traits\Replacor;


 class BaseGenerator
{   
    use Replacor;
    
    public $table_name;
    public $columnTypes = [];

    public  $VUE_PATH="js/Pages/"; //with trailing slash

 public  $CTL_PATH="app/Http/Controllers/Admin/"; //with trailing slash



    public $model_name;

    public $messages = [];
    protected $replacements=[];

    public  $tableHeadingItemsTemp = "{ key:'{{fieldName}}',cell:'text',visible:true, value: '{{fieldName}}'},\n";

    
    protected $unwantedColumns = [
        'id',
        // 'password',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'uuid',
    ];

   



    public function fileAppend($file,$txt)
    {
         if(strpos(file_get_contents($file),$txt)){
            return false;
        }
        
        try {
            file_put_contents($file,$txt.PHP_EOL , FILE_APPEND | LOCK_EX);
            return true;

        } catch (\Throwable $th) {
            return false;
        }
        

    }

    public function createFile($template,$path,$folderName,$fileNameWithExt)
    {
     
        
        if (!File::exists(resource_path($path.$folderName))) {

            File::makeDirectory(resource_path($path).$folderName,0755);

        }
        if (!File::exists(resource_path($path.$folderName.'/'.$fileNameWithExt))) {

                File::put(resource_path($path.$folderName.'/'.$fileNameWithExt),$template);
                return ['success'=> $fileNameWithExt .' file created'];
          }else{
                return ['error'=> $fileNameWithExt .' exists . Not created'];

          }
       
    }


    public function generateTemplateFrom($replacements,$folder,$stubname):string
    {
           $stub=$this->getStub("/../../stubs/${folder}/${stubname}");
        $template= $this->replaceArray($stub,$replacements);
        
 
            return $template;
      
       
    }
     public function getStub($name)
    {
        

        $template= File::get(__DIR__.$name.'.stub');
        return  $template;

    }

    public function buildClassName()
    {
        return   Str::studly(Str::singular($this->table_name));
    }

   
    
    public function tableExists()
    {
        return Schema::hasTable($this->table_name);
    }
    
  
    



}