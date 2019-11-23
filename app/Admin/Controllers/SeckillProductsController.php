<?php
namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;


class SeckillProductsController extends CommonProductsController
{




   public function getProductType()
   {
       // TODO: Implement getProductType() method.

       return Product::TYPE_SECKILL;
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

        $grid->column('seckill.start_at','秒杀开始时间');
        $grid->column('seckill.end_at','秒杀结束时间');


    }

    public function customForm($form)
    {
        // TODO: Implement customForm() method.

        $form->hidden('type')->value(Product::TYPE_SECKILL);
        $form->datetime('seckill.start_at','秒杀开始时间')->rules('required');

        $form->datetime('seckill.end_at','秒杀结束时间')->rules('required');
    }


}