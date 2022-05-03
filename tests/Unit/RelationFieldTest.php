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

        $this->assertStringContainsString("name='cat_id'",$generatedCreateFileTemp);
        $this->assertStringContainsString("cat_id : null",$generatedCreateFileTemp);
        $this->assertStringContainsString("setCat_id(data)",$generatedCreateFileTemp);
        $this->assertStringContainsString("getCat_id()",$generatedCreateFileTemp);
        $this->assertStringContainsString(" await fetch('/api/categories",$generatedCreateFileTemp);
        
    }

    public function test_relation_field_has_relation_data()
    {
        $r = new RelationField($this->columns[1]);

        $this->assertEquals($this->columns[1]['relation']['tableName'],$r->data['relationTableName']);

        $this->assertMatchesRegularExpression(
    '/Exception 40\d/', 
    'Exception 401', 
    'Check if it is exception 40x'
);


    }

   

    
}
