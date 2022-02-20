<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait CrudCreate {

 public  $VUE_PATH="js/Pages/"; //with trailing slash
 
  public $postFieldTemplate = "\t\t\t {{field}} : this.{{field}} ,\n ";
  public $dataFieldTemplate = "\t\t\t {{field}} : null ,\n ";
  public $dataOptionsTemplate = "\t\t\t {{fieldName}} : {
                                    \t\t\t\t  visibleField:'{{visibleField}}',
                                    \t\t\t\t  valueField:'{{valueField}}',
                                    \t\t\t\t  items:[
                                    \t\t\t\t  
                                    \t\t\t\t  ] ,\n ";

  public $inputTemplate = "\t\t\t <input-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n "; 


  public $checkboxTemplate = "\t\t\t <checkbox-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n "; 

  public $optionsTemplate = "\t\t\t <options-field name='{{fieldName}}' :options='{{options}}' label='{{label}}' :initialValue='{{fieldName}}'  @inputChanged='set{{fieldNameUp}}'/> \n"; 
  
  public $textareaTemplate = "\t\t\t <textarea-field name='{{fieldName}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}' :initialValue='{{fieldName}}' /> \n"; 
  public $ckeditorTemplate = "\t\t\t  <ckeditor-component name='{{fieldName}}' label='Enter  {{fieldName}}' :initialValue='{{fieldName}}'  @inputChanged='set{{fieldNameUp}}' /> \n"; 
  public $imageUploadTemplate = "\t\t\t 
  <file-pond-image-upload  name='{{fieldName}}' label='Upload Image' 
    @imageUploaded='set{{fieldNameUp}}' :initialValue='{{fieldName}}'
  /> \n"; 
  public $setFunctionTemplate = "\t\t\t 
   \t\t\tset{{fieldNameUp}}(data){\n
     \t\t\tthis.{{fieldName}} = data.value \n
     \t\t\t},\n"; 

/*

  $relationDataTemplate is appended with datafields and inserted into 	{{dataFields}}
*/
  public $relationDataOptionsTemplate = "\t\t\t 	{{fieldName}}RelationOptions:{
                      \t\t\t	visibleField:'{{visibleField}}',
                      \t\t\t	valueField:'{{valueField}}',
                        \t\t\t	items:[]
                      \t\t\t},  \n ";


  /*
  $setRelationFunctionTemplate is appended to setFunctionTemplate and 
   inserted into {{setFunctions}} 
*/



  public $setRelationFunctionTemplate = "\t\t\t get{{fieldNameUp}}(){
					 (async () => {
					 const rawResponse = await fetch('/api/{{tableName}}', {
						method: 'GET',
					 headers: {
					 'Accept': 'application/json',
					 'Content-Type': 'application/json',
					 'X-CSRF-TOKEN' :this.\$page.props.csrf,
					 'Authorization' : 'Bearer ' + this.\$page.props.token,
					 }
						});
						 const content = await rawResponse.json();
						 this.{{fieldName}}RelationOptions.items = content.data
					 })();
			 },";

  /*
    $relationComponentTemplate is appended to createFields 
    and inserted into {{createFields}}
  */
       public $relationInputTemplate	= "\t\t\t  <options-field name='{{fieldName}}' :options='{{fieldName}}RelationOptions' label='Choose {{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> 
       
       ";


       /*
       also create $onMountFunctionTemplate and append to onMountActions
       */


  public function generateVueCreate()
  {
    
        $generatedCreateFile = $this->generateTemplateFrom($this->replacements,'vue','Create');

           $message = $this->createVueFile($this->replacements,$generatedCreateFile,$this->VUE_PATH,'Create.vue');
          $this->messages[] = $message;
           
           return $this;

  }
    public function makeSetFunctions()
    {
         $temp = '';
        foreach ($this->columns as  $v) {
              if ($v['fieldType']=='relation') {
                 $temp.= $this->replace($this->setRelationFunctionTemplate,[
                'fieldName'=>$v['fieldName'],
                'fieldNameUp'=>ucfirst($v['fieldName']),
                 'tableName'=>$v['relation']['tableName'],
                
                
                ]);
                $this->addFunctionToBeforeMount("get".ucfirst($v['fieldName']));
              }

            $temp.= $this->replace($this->setFunctionTemplate,[
                'fieldName'=>$v['fieldName'],
                 'fieldNameUp'=>ucfirst($v['fieldName']),
                
                
                ]);

        }
        return $temp;
    }
    
    
    public function makeInputFields()
    {
       
      

      $temp = '';
        foreach ($this->columns as  $v) {
          $t = $this->whichTemplateToUse($v['fieldType']);

          //  if ($v['fieldType'] == 'relation') {
          //    $temp.= $this->replace($t['temp'],[
          //       'fieldName'=>$v['fieldName'],
          //       'fieldNameUp'=>ucfirst($v['fieldName']),
          //       'fieldType' =>$t['fieldType'],
          //       'label' => 'Enter '.$v['fieldName'],
                
          //       ]);

          

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

        foreach ($this->columns as  $column) {
          if ($column['fieldType'] == 'relation') {
            
               $r = $this->replace($this->relationDataOptionsTemplate,[
                 'fieldName'=>"${column['fieldName']}",
                 'valueField'=>$column['relation']['modelId'],
                 'visibleField'=>$column['relation']['modelText'],
                 
                 ]);
          
              $temp .= $r;

          }

              $r = $this->replace($this->dataFieldTemplate,['field'=>$column['fieldName']]);
          
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
          case 'relation':
          return ['temp'=>$this->relationInputTemplate,'fieldType'=>'relation'];
            break;
          case 'textarea':
          case 'mediumText':
          return ['temp'=>$this->textareaTemplate,'fieldType'=>'text'];
            break;
        
          
          default:
          return ['temp'=>$this->inputTemplate,'fieldType'=>'text'];
            
            break;
            // boolean
        }
      }
  
      public function createVueFile($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName']))) {

            $this->filesystem->makeDirectory(resource_path($PATH).$replacements["folderName"],0755);

        }
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt))) {

                $this->filesystem->put(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt),$template);
                return ['message'=> $fileNameWithExt .' file created'];
          }else{
                return ['message'=> $fileNameWithExt .' exists . Not created'];

          }
       
    }


}