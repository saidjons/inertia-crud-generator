<?php

namespace Saidjon\InertiaCrudGenerator\Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Facade;
use Saidjon\InertiaCrudGenerator\Fields\TextField;
use Saidjon\InertiaCrudGenerator\Generator\Generator;

class TextFieldTest extends TestCase
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
    
    public function test_vue_create_template_has_title_and_textinput()
    {
        
        $generatedCreateFile = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');

        $this->assertStringContainsString('setTitle(data)',$generatedCreateFile);
        $this->assertStringContainsString('title : null',$generatedCreateFile);
        $this->assertStringContainsString("name='title'",$generatedCreateFile);
    }

    public function test_textField_has_method_data()
    {
        $r = new TextField($this->columns[0]);
         
        $this->assertNotEmpty($r->getData()['method']);
        
    }

    
}
