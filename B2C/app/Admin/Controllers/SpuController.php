<?php

namespace App\Admin\Controllers;

use App\Models\GoodSpu;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Admin\Extensions\Tools\SpuGender;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodSpec;

class SpuController extends Controller
{
    use HasResourceActions;


    public $id;
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content,Request $req)
    {   
        $this->id = $req->good_id;

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
        session(['spu'=>'edit']);
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
        session(['spu'=>'create']);
        $this->id = $req->id;

        return $content
            ->header('Create')
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
        $grid = new Grid(new GoodSpu);

        // 修改数据源
        $grid->model()->where('good_id',$this->id);
        // 禁用创建按钮
        $grid->disableCreateButton();
        // 添加按钮
        $grid->tools(function ($tools) {
            $tools->append(new SpuGender($this->id));
        });


        $grid->path('单品')->display(function($path){
            $arr = explode('-',$path);
            $str = "";
            foreach($arr as $v)
            {
                $spec = GoodSpec::where('id',$v)->first()['name'];
                $str .= $spec ? $spec : "";
            }
            return $str;
        });

        $grid->num('单品数量');
        $grid->price('单品价格');

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
        $show = new Show(GoodSpu::findOrFail($id));

        $show->good_id('Good id');
        $show->path('Path');
        $show->num('Num');
        $show->price('Price');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodSpu);

        // 处理数据
        $attrs = GoodAttr::where('good_id',$this->id)->get();
        $atr_val = [];
        foreach($attrs as $k => $v)
        {
            $values = GoodSpec::where('attr_id',$v['id'])->get()->pluck('name', 'id');
            $atr_val[$k] = $values;
        }
        foreach($atr_val as $k => $v)
        {
            $form->select('arr[]',$attrs[$k]['name'])->options($v);
        }
        
        $form->hidden('good_id', 'Good id')->default($this->id);
        $form->hidden('path', 'Path');
        $form->number('num', 'Num')->rules('required');
        $form->decimal('price', 'Price')->rules('required');

        $form->saving(function (Form $form) {
            if($form->arr)
            {
                foreach($form->arr as $v)
                {
                    if($v){
                        $form->path .= $v."-";
                    }     
                }
            }       
        });
            // 抛出成功信息
            $form->saved(function ($form) {
                if(session('spu')=='create'){
                    $success = new MessageBag([
                        'title'   => '添加成功',
                        'message' => '继续添加下一个单品',
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
