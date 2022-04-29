<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class TextareaField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <textarea-field name='{{fieldName}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}' :initialValue='{{fieldName}}' /> \n"; 

    public $fieldType = 'textarea';

    public $label = 'Enter ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
            "viewHtmlField" => "",
        ];
    }

}