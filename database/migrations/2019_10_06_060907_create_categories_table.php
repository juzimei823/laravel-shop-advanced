<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {


            $table->bigIncrements('id');
            //分类名称
            $table->string('name');
            //父级分类id  可以为Null
            $table->unsignedBigInteger('parent_id')->nullabel()->default(null);
            //定义一个外键约束引用categories表的id 并且定义级表关联模式 当父表删除 对应的字表也会被删除
            //innodb 支持外键约束
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            //判断是否有子目录  boolean  
            $table->boolean('is_directory');
            //分类的级别
            $table->unsignedInteger('level');
            //当前类的父级id
            $table->string('path');
            //create_at  update_at  的字段时间戳
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
        Schema::dropIfExists('categories');
    }
}
