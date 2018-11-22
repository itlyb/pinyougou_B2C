<?php

namespace App\Admin\Controllers;

use App\Models\GoodAttr;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Admin\Extensions\Tools\UserGender;
use App\Models\Good;

class AttrController extends Controller
{
    use HasResourceActions;

    public static $id;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content,Request $req)
    {   
        self::$id = $req->good_id;
    
        return $content
            ->header('Index')
            ->description('description')
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
        session(['atr'=>'edit']);
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content,Request $req)
    {   
        session(['atr'=>'create']);
        if(isset($req->id))
        {
            self::$id = $req->id;
        }   
        return $content
            ->header('添加商品属性规格')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodAttr);
        // 修改数据源
        $grid->model()->where('good_id',self::$id);
        // 禁用创建按钮
        $grid->disableCreateButton();
        // 添加按钮
        $grid->tools(function ($tools) {
            $tools->append(new UserGender(self::$id));
        });

        $grid->name('属性名');
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
        $show = new Show(GoodAttr::findOrFail($id));

        $show->id('Id');
        $show->good_id('Good id');
        $show->name('Name');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {   

        $form = new Form(new GoodAttr);

        $form->hidden('good_id', 'Good id')->default(self::$id);
        $form->text('name', '属性名')->rules('required');
        $form->hasMany('values', function (Form\NestedForm $form) {
            $form->text('name','属性值');
        });
        
        // 如果是创建时才返回这个提示，修改时则不返回提示
        $form->saved(function ($form) {

            if(session('atr')=='create'){
                $success = new MessageBag([
                    'title'   => '添加成功',
                    'message' => '请继续添加下一个属性',
                ]);
            }else
            {
                $success = new MessageBag([
                    'title'   => '修改成功',
                ]);
            }  
            
            return back()->with(compact('success'));
        });
        
        
        return $form;
    }

}
