<?php 

namespace Saidjon\InertiaCrudGenerator;

use Illuminate\Support\Facades\Log;

trait CrudCreate {

 public  $VUE_PATH="js/Pages/"; //with trailing slash

  public $createFileName = 'Create';
  public $postFieldTemplate = "\t\t\t {{field}} : this.{{field}} ,\n ";
  public $dataFieldTemplate = "\t\t\t {{field}} : null ,\n ";

  public $inputTemplate = "\t\t\t <input-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}'  @inputChanged='set{{fieldNameUp}}'/> \n "; 
  public $checkboxTemplate = "\t\t\t <checkbox-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}'  @inputChanged='set{{fieldNameUp}}'/> \n "; 

  public $optionsTemplate = "\t\t\t <options-field name='{{fieldName}}' :options='{{options}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}'/> \n"; 
  
  public $textareaTemplate = "\t\t\t <textarea-field name='{{fieldName}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}' /> \n"; 
  public $ckeditorTemplate = "\t\t\t  <ckeditor-component name='{{fieldName}}' label='Enter  {{fieldName}}'   @inputChanged='set{{fieldNameUp}}' /> \n"; 
  public $imageUploadTemplate = "\t\t\t 
  <file-pond-image-upload  name='{{fieldName}}' label='Upload Image' 
    @imageUploaded='set{{fieldNameUp}}'
  /> \n"; 
  public $setFunctionTemplate = "\t\t\t 
   \t\t\tset{{fieldNameUp}}(data){\n
     \t\t\tthis.{{fieldName}} = data.value \n
     \t\t\t},\n"; 


    public function makeSetFunctions()
    {
         $temp = '';
        foreach ($this->columns as  $v) {
          $t = $this->whichTemplateToUse($v['type']);
            $temp.= $this->replace($this->setFunctionTemplate,[
                'fieldName'=>$v['fieldName'],
                 'fieldNameUp'=>ucfirst($v['fieldName']),
                
                
                ]);

        }
        return $temp;
    }
    public function makeInputFieldsFromTerminal()
    {
       


      $temp = '';
        foreach ($this->columnsAndTypes as  $v) {
          $t = $this->whichTemplateToUse($v['type']);
            $temp.= $this->replace($t['temp'],[
                'fieldName'=>$v['fieldName'],
                'fieldNameUp'=>ucfirst($v['fieldName']),
                'fieldType' =>$t['fieldType'],
                'label' => 'Enter '.$v['fieldName'],
                
                ]);

        }
        return $temp;
    }
    public function makeInputFields()
    {
       
      

      $temp = '';
        foreach ($this->columns as  $v) {
          $t = $this->whichTemplateToUse($v['type']);
            $temp.= $this->replace($t['temp'],[
                'fieldName'=>$v['fieldName'],
                 'fieldNameUp'=>ucfirst($v['fieldName']),
                'fieldType' =>$t['fieldType'],
                'label' => 'Enter '.$v['fieldName'],
                
                ]);

        }
        return $temp;
    }
    public function makePostFields()
    {
        $temp = ' ';

        foreach ($this->columns as     $f) {
              $r = $this->replace($this->postFieldTemplate,['field'=>$f['fieldName']]);
              $temp .= $r;
        }
        return $temp;
    }
    public function makeDataFields()
    {
        $temp = ' ';

        foreach ($this->columns as  $f) {
              $r = $this->replace($this->dataFieldTemplate,['field'=>$f['fieldName']]);
              $temp .= $r;
        }
        return $temp;
    }

      public function whichTemplateToUse($fieldType)
      {
        switch ($fieldType) {
          case 'int':
          case 'bigint':
          return ['temp'=>$this->inputTemplate,'fieldType'=>'number'];
            break;
          case 'checkbox':
          return ['temp'=>$this->checkboxTemplate,'fieldType'=>'checkbox'];
            break;
              case 'ckeditor':
          return ['temp'=>$this->ckeditorTemplate,'fieldType'=>'text'];
            break;
         
          case 'datetime':
          return ['temp'=>$this->inputTemplate,'fieldType'=>'datetime'];
            break;
          case 'imageUpload':
          return ['temp'=>$this->imageUploadTemplate,'fieldType'=>'text'];
            break;
          case 'string':
          case 'text':
          return ['temp'=>$this->inputTemplate,'fieldType'=>'text'];
            break;
          case 'enum':
          case 'options':
          return ['temp'=>$this->optionsTemplate,'fieldType'=>'options'];
            break;
          case 'textarea':
          case 'mediumText':
          return ['temp'=>$this->textareaTemplate,'fieldType'=>'text'];
            break;
        
          
          default:
          return ['temp'=>$this->inputTemplate,'fieldType'=>'number'];
            
            break;
            // boolean
        }
      }
    public function generateCreateVue($replacements):string
    {
           $createVue=$this->getStub("vue/Create");
        $createVue= $this->replace($createVue,$replacements);
        
 
  return $createVue;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }
      public function fileWriterCreate($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName']))) {

            $this->filesystem->makeDirectory(resource_path($PATH).$replacements["folderName"],0755);

        }
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt))) {

                $this->filesystem->put(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);
                return ['message'=> 'Create.vue file created'];
          }else{
                return ['message'=> 'Create.vue exists . Not created'];

          }
       
    }


}