<?php

namespace Saidjon\InertiaCrudGenerator\Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Facade;
use Saidjon\InertiaCrudGenerator\Fields\RelationField;
use Saidjon\InertiaCrudGenerator\Generator\Generator;

class InertiaCrudTest extends TestCase
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
    
    public function test_assert_table_exists()
    {
        // $this->assertSame('users','users');

        $this->assertEquals('users', $this->gen->table_name);
    }

    public function test_table_has_columns()
    {
        $this->gen->setColumnTypes()->filterColumns();

        $this->assertGreaterThan(3,count( $this->gen->setColumnTypes()->filterColumns()->getColumnTypes()));
    }

    public function test_postColumn_is_set()
    {
     
        $this->assertArrayHasKey('fieldName',$this->gen->postCols[0]);
        $this->assertGreaterThanOrEqual(2,count($this->gen->postCols));
        $this->assertSame('title',$this->gen->postCols[0]['fieldName'],'title field exists');
    }

    public function test_replacement_method_key_is_not_empty()
    {
        $this->assertNotEmpty($this->gen->replacements['method']);
    }
   


 

}
