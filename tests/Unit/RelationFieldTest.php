<?php

namespace Saidjon\InertiaCrudGenerator\Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Facade;
use Saidjon\InertiaCrudGenerator\Fields\TextField;
use Saidjon\InertiaCrudGenerator\Generator\Generator;
use Saidjon\InertiaCrudGenerator\Fields\RelationField;

class RelationFieldTest extends TestCase
{
    public $gen;
    public $columns;
    public function setUp():void
    {
        $this->gen = new Generator('users');
        $columns = [
            ['fieldName'=>'title',
            'className'=>'TextField'
            ],
            ['fieldName'=>'cat_id',
            'className'=>'RelationField',
            'relation'=>[
                'tableName'=>'categories',
                'visibleField' =>'title',
                'valueField' =>'id',
            ]
            ],
           
        
        ];
        
        $this->columns=$columns;

        if (! $this->app) {
            $this->refreshApplication();
        }
        Facade::clearResolvedInstances();
        $this->gen->setPostedColumns($columns);
        $this->gen->setReplacement()->fillReplacements();
    
    
    }
    
    public function test_vue_create_template_has_relation_field()
    {
        $generatedCreateFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');
        // relation html field exixst
        $this->assertStringContainsString("name='cat_id'",$generatedCreateFileTemp);
        // relation field exists in data({})
        $this->assertStringContainsString("cat_id : null",$generatedCreateFileTemp);
        // relation onchange set function exists
        $this->assertStringContainsString("setCat_id(data)",$generatedCreateFileTemp);
        // relation get data from api function exists
        $this->assertStringContainsString("getCat_id()",$generatedCreateFileTemp);
        // relation tablename is set in get from api function
        $this->assertStringContainsString(" await fetch('/api/categories",$generatedCreateFileTemp);

        // relation get api function is run on vue mounted
        $this->assertStringContainsString("this.get".ucfirst($this->columns[1]['fieldName'])."()",$generatedCreateFileTemp);
        
    }

    public function test_vue_create_has_get_relation_method()
    {
        $generatedCreateFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');
        
        $this->assertStringContainsString("get".ucfirst($this->columns[1]['fieldName']),$generatedCreateFileTemp);

    }


    public function test_edit_vue_has_relation_column()
    {
        $generatedEditFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Edit');
        $fieldNameUp = ucfirst($this->columns[1]['fieldName']);

        // relation function run when mounted
        $this->assertStringContainsString("this.get".$fieldNameUp."()",$generatedEditFileTemp);
        // relation get function exists
        $this->assertStringContainsString("get".$fieldNameUp."()",$generatedEditFileTemp);
        // relation get from api
        $this->assertStringContainsString(" await fetch('/api/".$this->columns[1]['relation']['tableName'],$generatedEditFileTemp);
        // relation data :null set
        $this->assertStringContainsString(strtolower($fieldNameUp)." : null",$generatedEditFileTemp);

        
    }
   

    
}
