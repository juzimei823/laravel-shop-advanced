<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品类目列表')
            ->description('展示栏目列表')
            ->body($this->grid());
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
            ->description('description')
            ->body($this->detail($id));
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
            ->header('编辑栏目')
//            ->description('description')
            ->body($this->form(true)->edit($id));
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
            ->header('创建栏目')
//            ->description('description')
            ->body($this->form(false));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->id('Id');
        $grid->name('栏目名');
//        $grid->parent_id('Parent id');
        $grid->is_directory('是否有子目录')->display(function($val){

             return $val?'是':'否';
        });
        $grid->level('层级');
        $grid->path('类目路径');
//        $grid->created_at('创建时间');
//        $grid->updated_at('更新时间');
        $grid->actions(function ($actions) {
            // 不展示 Laravel-Admin 默认的查看按钮
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->id('Id');
        $show->name('栏目名');
//        $show->parent_id('Parent id');
        $show->is_directory('是否有子目录');
        $show->level('层级');
        $show->path('类目路径');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($isEditing=false)
    {
        //创建一个栏目模型表单
        $form = new Form(new Category);
         //文本表单域
        $form->text('name', '栏目名称')->rules('required');

        //如果是编辑的情况下

        if($isEditing){
            //display 显示表单字段但不能编辑
            $form->display('is_directory','是否有目录')->with(function($val){

                return $val?'是':'否';
            });
            $form->display('parent.name', '父类目');
        }else{
            //单选按钮组件
            $form->radio('is_directory','是否有目录')
                ->options(['1'=>'是','0'=>'否'])
                ->default('0')
                ->rules('required');
            //选择表单
            $form->select('parent_id', '父级栏目')->ajax('/admin/api/categories');
        }

//        $form->switch('is_directory', 'Is directory');

        return $form;
    }

    /**
     *
     * 下拉搜索接口
     * @param Request $request
     *
     */
    protected function apiIndex(Request $request){

          $search = $request->input('q');


          $result = Category::query()->where('is_directory',boolval($request->input('is_directory',true)))
              ->where('name','like','%'.$search.'%')->paginate();



//          $result->map()
//          dump($result);
        // 把查询出来的结果重新组装成 Laravel-Admin 需要的格式
        $result->setCollection($result->getCollection()->map(function (Category $category) {
            return ['id' => $category->id, 'text' => $category->name];
        }));

        return $result;



    }





}
