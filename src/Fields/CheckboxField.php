<?php

namespace Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;

    class CheckboxField extends BaseField
    {

        protected $createHtmlTemp = "\t\t\t <checkbox-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n ";

        public $fieldType = 'checkbox';

        public $label = 'Check ';
         

        public function getData():array
        {
            return [
                "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

                "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

                "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

                "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),

                "beforeMountSet" => "",
    
                "mountedSet" => "",
            "onMountedSetField" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

                
                "viewHtmlField" => "",
            ];
        }
    }