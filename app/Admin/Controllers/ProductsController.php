<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ProductsController extends CommonProductsController
{


    //必须实现抽象方法

    public function getProductType(){

          return Product::TYPE_NORMAL;
    }


    public function customGird($grid)
    {
        // TODO: Implement customGird() method.
        $grid->id('ID')->sortable();
        $grid->title('商品名称');
        $grid->column('category.name','栏目');
        $grid->on_sale('已上架')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->price('价格');
        $grid->rating('评分');
        $grid->sold_count('销量');
        $grid->review_count('评论数');
    }

    public function customForm($form)
    {
        // TODO: Implement customForm() method.
        $form->hidden('type')->default(Product::TYPE_NORMAL);
        // 定义事件回调，当模型即将保存时会触发这个回调
//        $form->saving(function (Form $form) {
//            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
//        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
//    protected function form()
//    {
//        $form = new Form(new Product);
//
//
//        $form->hidden('type')->default(Product::TYPE_NORMAL);
//        // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
//        $form->text('title', '商品名称')->rules('required');
//
//        //添加一个栏目
//        //Laravel-Admin 会把 category_id 字段值传给匿名函数，
//        //匿名函数需要返回 [id => value] 格式的返回值。
//        $form->select('category_id','栏目')->options(function($id){
//                 $category = Category::find($id);
//
//                 if($category){
//
//                      return [$category->id=>$category->name];
//
//                 }
//
//
//        })->ajax('/admin/api/categories?is_directory=0');
//
//        // 创建一个选择图片的框
//        $form->image('image', '封面图片')->rules('required|image');
//
//        // 创建一个富文本编辑器
//        $form->editor('description', '商品描述')->rules('required');
//
//        // 创建一组单选框
//        $form->radio('on_sale', '上架')->options(['1' => '是', '0'=> '否'])->default('0');
//
//        // 直接添加一对多的关联模型
//        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
//            $form->text('title', 'SKU 名称')->rules('required');
//            $form->text('description', 'SKU 描述')->rules('required');
//            $form->text('price', '单价')->rules('required|numeric|min:0.01');
//            $form->text('stock', '剩余库存')->rules('required|integer|min:0');
//        });
//
//        // 定义事件回调，当模型即将保存时会触发这个回调
//        $form->saving(function (Form $form) {
//            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
//        });
//
//        return $form;
//    }








}
