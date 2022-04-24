<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class RelationField extends BaseField
{

    protected $createHtmlTemp = "\t\t\t  <options-field name='{{fieldName}}' :options='{{fieldName}}RelationOptions' label='Choose {{fieldName}}' @inputChanged='set{{fieldNameUp}}'/>";

    protected $fieldType = 'relation';


    public function appendDataField()
    {
        
        /*

        $relationDataTemplate is appended with datafields and inserted into 	{{dataFields}}
        */
        $relationDataOptionsTemplate = "\t\t\t 	{{fieldName}}RelationOptions:{
            \t\t\t	visibleField:'{{visibleField}}',
            \t\t\t	valueField:'{{valueField}}',
            \t\t\t	items:[]
            \t\t\t},  \n ";

    }
    public function appendMethod()

    {
        /*
        $setRelationFunctionTemplate is appended to setFunctionTemplate and 
        inserted into {{setFunctions}} 
        */

        /*
       also create $onMountFunctionTemplate and append to onMountActions
       */
      
        $setRelationFunctionTemplate = "\t\t\t get{{fieldNameUp}}(){
            (async () => {
            const rawResponse = await fetch('/api/{{tableName}}', {
               method: 'GET',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN' :this.\$page.props.csrf,
            'Authorization' : 'Bearer ' + this.\$page.props.token,
            }
               });
                const content = await rawResponse.json();
                this.{{fieldName}}RelationOptions.items = content.data
            })();
    },";

    }
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
            "viewHtmlField" => "",
        ];
    }

}