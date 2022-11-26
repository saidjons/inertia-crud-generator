<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class TextField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <InputField  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n "; 
    
 
  
    public $fieldType = 'text';

    public $label = 'Enter ';
 

    public function getData():array
    {
        return [
 

 
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "onMountedSetFieldEdit" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

            "beforeMountSet" => "",

            "mountedSet" => "",
            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

 
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
 
            "viewHtmlField" => "",
 
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
 


        ];
    }

}