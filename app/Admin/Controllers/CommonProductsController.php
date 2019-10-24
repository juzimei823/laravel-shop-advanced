<?php
namespace App\Admin\Controllers;
//定义一个商品抽象类
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\HasResourceActions;

abstract class CommonProductsController extends Controller
{


    use HasResourceActions;



    //定义一个抽象的商品类型

    abstract public function getProductType();
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(Product::$typeMap[$this->getProductType()].'列表')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑'.Product::$typeMap[$this->getProductType()])
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建'.Product::$typeMap[$this->getProductType()])
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);
        $grid->model()->where('type',$this->getProductType())->orderBy('id','desc');
        //调用自定义的Grid

        $this->customGird($grid);
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Product);

//        $form->text('type', 'Type')->default('normal');
//        $form->number('category_id', 'Category id');

        //增加一个隐藏域的type
//        $form->hidden('type')->value(Product::TYPE_CROWDFUNDING);
        //商品名称
        $form->text('title', '商品名称')->rules('required');

        $form->text('long_title', '商品长标题')->rules('required');
        //商品类目选择
        $form->select('category_id','栏目')->options(function($id){
            $category = Category::find($id);
            if($category){
                return [$category->id=>$category->name];

            }

        })->ajax('/admin/api/categories?is_directory=0');
//            ->ajax();
        //商品主图
        $form->image('image', '商品图片')->rules('required|image');
        //商品描述
        $form->editor('description','商品描述')->rules('required');
//        $form->textarea('description', 'Description');
        //商品是否上架

        $form->radio('on_sale','上架')->options(['1'=>'是','0'=>'否'])->default(0);


        //添加众筹相关的字段
        $this->customForm($form);
//        $form->text('crowdfunding.target_amount','目标金额')->rules('required|numeric|min:0.01');
//        $form->datetime('crowdfunding.end_at','众筹结束时间')->rules('required|date');
        //关联的skus 商品

        $form->hasMany('skus','商品skus',function(Form\NestedForm $form){

            $form->text('title', 'SKU 名称')->rules('required');
            $form->text('description', 'SKU 描述')->rules('required');
            $form->text('price', '单价')->rules('required|numeric|min:0.01');
            $form->text('stock', '剩余库存')->rules('required|integer|min:0');


        });
        //关联商品属性

        $form->hasMany('properties','商品属性',function(Form\NestedForm $form){
            $form->text('name', '属性名称')->rules('required');
            $form->text('value', '属性值')->rules('required');


        });
        //保存之前会创建
        $form->saving(function(Form $form){

            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;


        });

//        $form->switch('on_sale', 'On sale')->default(1);
//        $form->decimal('rating', 'Rating')->default(5.00);
//        $form->number('sold_count', 'Sold count');
//        $form->number('review_count', 'Review count');
//        $form->decimal('price', 'Price');

        return $form;
    }

    abstract public function customGird($grid);



    abstract public function customForm($form);








}






