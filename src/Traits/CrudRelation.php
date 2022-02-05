<?php

namespace Saidjon\InertiaCrudGenerator\Traits;

trait CrudRelation
{


  /* 
    relation template    inserted into {{relationFields}}  

  */
  public $relationTemplate = "\t\t\t   \n, ";


/*

  $optionsFieldTemplate is appended with datafields and inserted into 	{{dataFields}}
*/
  public $optionsFieldTemplate = "\t\t\t 	{{fieldName}}Options:{
                      \t\t\t	visibleField:'name',
                      \t\t\t	valueField:'id',
                        \t\t\t	items:[]
                      \t\t\t},  \n ";


  /*
  $setRelationFunctionTemplate is appended to setFunctionTemplate and 
   inserted into {{setFunctions}} 
*/



  public $setRelationFunctionTemplate = "\t\t\t set{{fieldName}}(){
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
						 this.{{fieldName}}Options.items = content
					 })();
			 },";

  /*
    $relationComponentTemplate is appended to createFields 
    and inserted into {{createFields}}
  */
       public $relationComponentTemplate	= "\t\t\t  <options-field name='{{fieldName}}' :options='{{fieldName}}Options' label='Choose {{fieldName}}' @inputChanged='set{{fieldName}}'/> 
       
       ";


       /*
       also create $onMountFunctionTemplate and append to onMountActions
       */
}
