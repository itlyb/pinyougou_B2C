<?php

namespace App\Admin\Controllers;

use App\Models\GoodType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TypeController extends Controller
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
            ->header('商品类型管理')
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
    public function create(Content $content)
    {
        return $content
            ->header('创建商品类型')
            ->description('添加新类型')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {   
        $grid = new Grid(new GoodType);

        $grid->id('Id');
        $grid->column('Name')->display(function () {
            $str = str_repeat('&nbsp;&nbsp;',(count(explode('-',$this->path))-2)*4);
            return $str.$this->name;
        });
        $grid->pid('Pid');
        $grid->path('Path');
        // 设置初始排序条件
        $grid->model()->orderByRaw("CONCAT(path,id,'-') asc");
        
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
        $show = new Show(GoodType::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->pid('Pid');
        $show->path('Path');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodType);

        // 数据处理
        $data = GoodType::orderByRaw("CONCAT(path,id,'-') asc")->get();
        $params = [];
        $params[0] = "根级";
        foreach($data as $v)
        {   
            $str = str_repeat("&nbsp;&nbsp;",(count(explode('-',$v['path']))-2)*4);
            $params[$v['id']] = $str.$v['name'];
        }

        $form->text('name', 'Name')->rules('required');
        $form->select('pid', 'Pid')->options($params)->rules('required');
        $form->hidden('path', 'Path');

        $form->saving(function (Form $form) {
            if($form->pid == 0){
                $form->path = "-";
            }
            else
            {
                $path = GoodType::where('id',$form->pid)->first();
                $form->path = $path['path'].$form->pid."-";
            }
        });
        

        return $form;
    }
}
