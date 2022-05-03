<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class ImageUploadField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <file-pond-image-upload  name='{{fieldName}}' label='Upload Image' @imageUploaded='set{{fieldNameUp}}' :initialValue='{{fieldName}}'
    /> \n"; 
    public $fieldType = 'imageUpload';

    public $label = 'Upload Image  ';
    
    

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