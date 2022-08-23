<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class JsonEditorField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <json-editor-component  name='{{fieldName}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}' :initialValue='{{fieldName}}'
    editorSettings='menu'/>\n";



    public $label = 'Enter ';




    public $fieldType = 'jsonEditor';






    public function getData(): array
    {
        return [
            "createHtmlField" => $this->makeField($this->createHtmlTemp, $this->data),

            "postField" => $this->replace($this->postFieldTemp, 'fieldName', $this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp, 'fieldName', $this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp, $this->data),

            "beforeMountSet" => "",

            "onMountedSetFieldEdit" => $this->replace($this->onMountedSetFieldTemp, 'fieldName', $this->data['fieldName']),
            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp, 'fieldName', $this->data['fieldName']),



            "viewHtmlField" => $this->replaceArray($this->viewHtmlTemp, $this->data),
        ];
    }
}
