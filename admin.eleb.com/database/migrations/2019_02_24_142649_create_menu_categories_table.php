<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');
            //菜品分类表
            $table->string('name')->default('')->comment('菜品名称');
            $table->string('type_accumulation')->default('')->comment('菜品编号');
            $table->integer('shop_id')->comment('所属商铺');
            $table->string('description')->default('')->comment('描述');
            $table->integer('is_selected')->comment('是否为默认分类1是0否');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
    }
}
