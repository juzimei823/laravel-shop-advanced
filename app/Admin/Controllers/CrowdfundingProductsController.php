<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\CrowdfundingProduct;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 *
 * desc  当创建laravel-admin控制器  的时候  --model= 代表的是关联的模型
 * Class CrowdfundingProductsController
 * @package App\Admin\Controllers
 */

class CrowdfundingProductsController extends CommonProductsController
{


    //实现抽象类
    public function getProductType()
    {
        // TODO: Implement getProductType() method.

        return Product::TYPE_CROWDFUNDING;
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
//            ->description('description')
            ->body($this->detail($id));
    }
    public function customGird($grid)
    {
        // TODO: Implement customGird() method.
        $grid->id('Id')->sortable();
//        $grid->type('商品类型');
//        $grid->category_id('Category id');
        $grid->title('商品名称');
//        $grid->description('Description');
//        $grid->image('Image');
        $grid->on_sale('已上架')->display(function($value){
            return $value ? '是':'否';

        });
        $grid->price('价格');

        $grid->column('crowdfunding.target_amount','目标金额');
        $grid->column('crowdfunding.end_at','结束时间');
        $grid->column('crowdfunding.total_amount','目前金额');
        $grid->column('crowdfunding.status','状态')->display(function($value){

            return CrowdfundingProduct::$statusMap[$value];

        });

    }
    public function customForm($form)
    {
        // TODO: Implement customForm() method.

        $form->hidden('type')->value(Product::TYPE_CROWDFUNDING);
        $form->text('crowdfunding.target_amount','目标金额')->rules('required|numeric|min:0.01');
        $form->datetime('crowdfunding.end_at','众筹结束时间')->rules('required|date');
        //保存之前会执行闭包函数
//        $form->saving(function(Form $form){
//
//            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
//
//
//        });

    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->id('Id');
        $show->type('Type');
        $show->category_id('Category id');
        $show->title('Title');
        $show->description('Description');
        $show->image('Image');
        $show->on_sale('On sale');
        $show->rating('Rating');
        $show->sold_count('Sold count');
        $show->review_count('Review count');
        $show->price('Price');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
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
////        $form->text('type', 'Type')->default('normal');
////        $form->number('category_id', 'Category id');
//
//        //增加一个隐藏域的type
//        $form->hidden('type')->value(Product::TYPE_CROWDFUNDING);
//        //商品名称
//        $form->text('title', '商品名称')->rules('required');
//        //商品类目选择
//        $form->select('category_id','栏目')->options(function($id){
//               $category = Category::find($id);
//               if($category){
//                   return [$category->id=>$category->name];
//
//               }
//
//        })->ajax('/admin/api/categories?is_directory=0');
////            ->ajax();
//        //商品主图
//        $form->image('image', '商品图片')->rules('required|image');
//        //商品描述
//        $form->editor('description','商品描述')->rules('required');
////        $form->textarea('description', 'Description');
//         //商品是否上架
//
//         $form->radio('on_sale','上架')->options(['1'=>'是','0'=>'否'])->default(0);
//
//        //添加众筹相关的字段
//
//        $form->text('crowdfunding.target_amount','目标金额')->rules('required|numeric|min:0.01');
//        $form->datetime('crowdfunding.end_at','众筹结束时间')->rules('required|date');
//        //关联的skus 商品
//
//        $form->hasMany('skus','商品skus',function(Form\NestedForm $form){
//
//            $form->text('title', 'SKU 名称')->rules('required');
//            $form->text('description', 'SKU 描述')->rules('required');
//            $form->text('price', '单价')->rules('required|numeric|min:0.01');
//            $form->text('stock', '剩余库存')->rules('required|integer|min:0');
//
//
//        });
//        //保存之前会创建
//        $form->saving(function(Form $form){
//
//            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price');
//
//
//        });
//
////        $form->switch('on_sale', 'On sale')->default(1);
////        $form->decimal('rating', 'Rating')->default(5.00);
////        $form->number('sold_count', 'Sold count');
////        $form->number('review_count', 'Review count');
////        $form->decimal('price', 'Price');
//
//        return $form;
//    }
}
