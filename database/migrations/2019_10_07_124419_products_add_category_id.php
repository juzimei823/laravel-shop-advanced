<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsAddCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //给商品添加一个分类的id 修饰符可以为null  字段排序到id之后

            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //添加一个外键约束
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //删除外键约束和列

            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
        });
    }
}
