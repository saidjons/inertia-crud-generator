<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class InputField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <input-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n "; 
    
    protected $fieldType = 'input';

    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,$this->data),

            "dataField" => $this->replace($this->dataFieldTemp,$this->data),

            "method" => $this->replace($this->setFunctionTemp,$this->data),

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
            "viewHtmlField" => "",


        ];
    }

}