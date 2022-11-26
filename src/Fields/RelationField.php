<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Illuminate\Support\Facades\Log;
use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class RelationField extends BaseField
{

    protected $createHtmlTemp = "\t\t\t  <OptionsField name='{{fieldName}}' :initialValue='{{fieldName}}' :options='{{fieldName}}RelationOptions' label='Choose {{fieldName}}' @inputChanged='set{{fieldNameUp}}'/>";

    public $fieldType = 'relation';

    public $label = 'Select ';


        /*
        $setRelationFunctionTemplate is appended to setFunctionTemplate and 
        inserted into {{setFunctions}} 
        */

        /*
       also create $onMountFunctionTemplate and append to onMountActions
       */

    public $setRelationFunctionTemplate = "\t\t\t get{{fieldNameUp}}(){
        (async () => {
        const rawResponse = await fetch('/api/{{relationTableName}}', {
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

          /*

         $relationDataTemplate is appended with datafields and inserted into 	{{dataFields}}
         */
         public $relationDataOptionsTemp = "\t\t\t 	{{fieldName}}RelationOptions:{
             \t\t\t	visibleField:'{{visibleField}}',
             \t\t\t	valueField:'{{valueField}}',
             \t\t\t	items:[]
             \t\t\t},  \n ";

        public function __construct(array $data)
        {
    
        $this->data = 
        [
                'fieldName'=>$data['fieldName'],
                'fieldType'=>$this->fieldType,
                'fieldNameUp'=>ucfirst($data['fieldName']),
            'label' => $this->label.$data['fieldName'],
            "relationTableName" =>$data['relation']['tableName']??'',
            "visibleField" =>$data['relation']['visibleField']??'',
            "valueField" =>$data['relation']['valueField']??'',
        ];
        }

      
    public function getData():array
    {

        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->setDataField(),

            "method" => $this->setMethod(),

            "beforeMountSet" => $this->replace($this->onMountedMethodTemp,'fieldName','get'.$this->data["fieldNameUp"]),


            "onMountedSetFieldEdit" => $this->setonMountedSetFieldEdit(),

            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
        ];
    }

    public function setMethod():string
    {
        $t =   $this->replaceArray($this->setRelationFunctionTemplate,$this->data);
        $t.=$this->replaceArray($this->setFunctionTemp,$this->data);
        return $t;
    }

    public function setDataField()
    {
        $t = $this->replaceArray($this->relationDataOptionsTemp,$this->data);
        $t.= $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']);

        return $t;
    }

    public function setonMountedSetFieldEdit()
    {
        $t = $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']);

        $t.=  $this->replace($this->onMountedMethodTemp,'fieldName','get'.$this->data['fieldNameUp']);

        return $t;

    }


}