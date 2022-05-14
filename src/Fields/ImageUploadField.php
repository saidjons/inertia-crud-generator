<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class ImageUploadField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t  
    	<upload-media 
		name='{{fieldName}}' 
         label='Upload Image' 
		 server='/admin/upload/image/'
		 multiple='false'
		 @imageUploaded='set{{fieldNameUp}}'
		  :initialValue='{{fieldName}}'
		 />
    
     \n"; 
    public $fieldType = 'imageUpload';

    public $label = 'Upload Image  ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

         
            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountSet" => "",

            "mountedSet" => "",
            "onMountedSetFieldEdit" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),
            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),

        ];
    }

}