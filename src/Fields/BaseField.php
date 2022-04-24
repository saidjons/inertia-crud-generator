<?php

namespace Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Traits\Replacor;

abstract class BaseField 
{
    use Replacor;

    public $data;

    public $table ;

    public $viewHtmlTemp = "\t\t\t <text-view  name='{{fieldName}}' label='{{label}}'     :initialValue='{{fieldName}}'/> \n "; 

    public   $setFunctionTemp = "\t\t\t 
    \t\t\tset{{fieldNameUp}}(data){\n
      \t\t\tthis.{{fieldName}} = data.value \n
      \t\t\t},\n"; 

     public $onMountedMethodTemp = "\t\t\t this.{{fieldName}}();\n";

    public $postFieldTemp = "\t\t\t {{fieldName}} : this.{{fieldName}} ,\n ";
    
    public $dataFieldTemp =  "\t\t\t {{fieldName}} : null ,\n ";



    public function __construct(array $a)
        {
            $data = [
                'fieldName'=>'fieldName',
                'fieldNameUp'=>ucfirst('fieldName'),
               'fieldType' =>'input',
               'label' => 'Enter fieldName',
            ];

            $this->data = 
                [
                        'fieldName'=>$data['fieldName'],
                     'fieldNameUp'=>ucfirst($data['fieldName']),
                    'fieldType' =>$this->fieldType,
                    'label' => 'Enter '.$data['fieldName'],
                    
                    
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
