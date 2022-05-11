<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Facade;
use Saidjon\InertiaCrudGenerator\Fields\TextField;
use Saidjon\InertiaCrudGenerator\Fields\OptionField;
use Saidjon\InertiaCrudGenerator\Generator\Generator;
use Saidjon\InertiaCrudGenerator\Fields\RelationField;

class OptionFieldTest extends TestCase
{
    public $gen;
    public $columns;
    public $optionWithoutKeys = [];

    public function setUp():void
    {
        $this->gen = new Generator('users');
        $this->columns = [
            ['fieldName'=>'title',
            'className'=>'TextField'
            ],
            ['fieldName'=>'cat_id',
            'className'=>'OptionField',
            'option'=> '{"values":[],"isWithKeys":true,"keyValues":[{"key":"1","value":"user"},{"key":"2","value":"editor"},{"key":"3","value":"teacher"},{"key":"4","value":"admin"}]} '
            ],
        
        ];
        $this->optionWithoutKeys = [
            ['fieldName'=>'title',
            'className'=>'TextField'
            ],
            ['fieldName'=>'cat_id',
            'className'=>'OptionField',
            'option'=> '{"keyValues":[],"isWithKeys":false,"values":["user","editor","admin"]} '
            ],
        
        ];


        if (! $this->app) {
            $this->refreshApplication();
        }
        Facade::clearResolvedInstances();
        $this->gen->setPostedColumns($this->columns);
        $this->gen->setReplacement()->fillReplacements();
    
    
    }
    
    public function test_optionField_has_column_cat_id()
    {
        $c = new OptionField($this->columns[1]);
        
        $this->assertArrayHasKey('fieldName',$c->data);
    }

    public function test_optionField_if_optionDataRaw_iswithKeys_equels_true_count_keyValues_gt_2()
    {
           $c = new OptionField($this->columns[1]);
           $this->assertEquals(true,  $c->optionDataRaw['isWithKeys']);
        $this->assertGreaterThan(2,count($c->optionDataRaw['keyValues']));
    }
    public function test_optionField_set_optionDataRaw()
    {
        $c = new OptionField($this->columns[1]);
        
        $this->assertIsArray($c->optionDataRaw);
    }
    public function test_optionField_optionDataRaw_has_keyValues_and_count_gt_2()
    {
        $c = new OptionField($this->columns[1]);
        
        $this->assertArrayHasKey('keyValues',$c->optionDataRaw);
    }

    public function test_optionField_optionItem_equels_to_optionDataRaw_keyValues()
    {
        $c = new OptionField($this->columns[1]);

        $this->assertEquals(count($c->optionDataRaw['keyValues']),count($c->optionItems));
        
    }

       public function  test_vue_create_template_has_option_field_withKeys()
    {
        $generatedCreateFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');
        // relation html field exixst
        $this->assertStringContainsString("name='cat_id'",$generatedCreateFileTemp);
        // relation field exists in data({})
        $this->assertStringContainsString("cat_id : null",$generatedCreateFileTemp);
        // relation onchange set function exists
        $this->assertStringContainsString("setCat_id",$generatedCreateFileTemp);

        // option Values isset
        $this->assertStringContainsString("title:'user'",$generatedCreateFileTemp);
        
    }

       public function  test_edit_vue_has_option_column()
    {
        $generatedEditFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Edit');
        $fieldNameUp = ucfirst($this->columns[1]['fieldName']);

        // relation data :null set
        $this->assertStringContainsString(strtolower($fieldNameUp)." : null",$generatedEditFileTemp);

    }

    public function  test_vue_create_withoutKeys_template_has_option_field()
    {

          $this->gen->setPostedColumns($this->optionWithoutKeys);
        $this->gen->setReplacement()->fillReplacements();
        $generatedCreateFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');
        // relation html field exixst
        $this->assertStringContainsString("name='cat_id'",$generatedCreateFileTemp);
        // relation field exists in data({})
        $this->assertStringContainsString("cat_id : null",$generatedCreateFileTemp);
        // relation onchange set function exists
        $this->assertStringContainsString("setCat_id",$generatedCreateFileTemp);

        // option Values isset
        $this->assertStringContainsString("title:'user'",$generatedCreateFileTemp);
        $this->assertStringContainsString("id:'user'",$generatedCreateFileTemp);
      
    }
 public function test_optionField_withoutKeys_optionDataRaw_has_keyValues_and_count_gt_2()
    {
        $c = new OptionField($this->optionWithoutKeys[1]);
        
        $this->assertArrayHasKey('values',$c->optionDataRaw);
         
         $this->assertGreaterThanOrEqual(2,count($c->optionDataRaw));
         
    }
    public function test_optionField_withoutKeys_optionItem_equels_to_optionDataRaw_keyValues()
    {
        $c = new OptionField($this->optionWithoutKeys[1]);

        $this->assertEquals(count($c->optionDataRaw['values']),count($c->optionItems));
        $this->assertGreaterThanOrEqual(2,count($c->optionItems));
    }
    
}
