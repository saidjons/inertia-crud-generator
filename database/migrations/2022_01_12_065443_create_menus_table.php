<?php

use Saidjon\InertiaCrudGenerator\Models\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('menus', function (Blueprint $table) {
            $table->id('id');
            $table->string('role');
            $table->json('data');
            $table->boolean('published')->nullable();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        Menu::create([
            'role' =>'admin',
            'published' =>1,
            'data' =>json_encode([
                'title' =>'Generator',
                 'link' =>'/admin/generator/create',
                'nested' => false,
                'badgeNumber' => '',
                'icon' =>'',
            ]),
        ]);
        Menu::create([
            'role' =>'admin',
            'published' =>1,
            'data' =>json_encode([
                'title' =>'Menu',
                 'link' =>'',
                'nested' => true,
                'badgeNumber' => '',
                'icon' =>'',
                   'subs' =>[
                        [ 'title'=>'create',
                            'link'=>'/admin/menu/create',
                            'badgeNumber' =>2,
                        ],
                           [ 'title' =>'List',
                            'link' =>'/admin/menu',
                            'badgeNumber' =>10,
                           ]
                      ]
            ]),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('menus');
    }
}
