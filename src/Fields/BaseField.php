<?php

namespace Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Traits\Replacor;
use Saidjon\InertiaCrudGenerator\Generator\BaseGenerator;

abstract class BaseField 
{
    use Replacor;

    public $data;

    public $table ;

    public $fieldType;
    

    public $label = ' '; 

    public $viewHtmlTemp = "\t\t\t <text-view  name='{{fieldName}}' label='{{label}}'     :initialValue='{{fieldName}}'/> \n "; 

    public   $setFunctionTemp = "\t\t\t 
    \t\t\tset{{fieldNameUp}}(data){\n
            console.log(data.value)
        if(data.value.length){
          this.audio = data.value[0].url;

        }else{

          this.audio = null;
        }
      \t\t\tthis.{{fieldName}} = data.value \n
      \t\t\t},\n";  

      
     public $onMountedMethodTemp = "\t\t\t this.{{fieldName}}();\n";

     public $onMountedSetFieldTemp = "\t\t\t this.{{fieldName}} = this.\$page.props.model.{{fieldName}};\n ";

    public $postFieldTemp = "\t\t\t {{fieldName}} : this.{{fieldName}} ,\n ";
    
    public $dataFieldTemp =  "\t\t\t {{fieldName}} : null ,\n ";


    public function __construct(array $data)
        {
      
            $this->data = 
                [
                        'fieldName'=>$data['fieldName'],
                        'fieldType'=>$this->fieldType,
                     'fieldNameUp'=>ucfirst($data['fieldName']),
                    'label' => $this->label.$data['fieldName'],
                    
                ];
                
        }
     
        

    public function setTable(string $table) 
    {
        $this->table = $table;
    }
   abstract  function getData():array;

   public function makeField(string $fieldHtml,array $data):string
   {
       $temp = $this->replaceArray($fieldHtml,$data);

           return $temp;
   }

   public function makeSetFunction ():string
    {
        $temp = $this->replaceArray($this->setFunctionTemplate,$this->data);
            return $temp;
    }

    
 

}
