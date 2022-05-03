<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class CkeditorField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t  <ckeditor-component name='{{fieldName}}' label='{{fieldName}}' :content='{{fieldName}}'  @inputChanged='set{{fieldNameUp}}' /> \n"; 

    public $fieldType = 'ckeditor';

    public $label = 'Fill ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

          
            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountSet" => "",
            "onMountedSetField" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),


            "mountedSet" => "",
            
            "viewHtmlField" => "",
        ];
    }

}