<?php

namespace App\Admin\Controllers;

use App\Models\Advert;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use Image as image;
use App\Models\AdvertType;

class AdvertController extends Controller
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
        $grid = new Grid(new Advert);

        // 搜索设定
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->equal('type','广告类型')->select(AdvertType::all()->pluck('name', 'id'));
            $filter->between('created_at', '创建时间')->datetime(); 
        });


        $grid->id('Id')->sortable();
        $grid->img('Img')->display(function($img){
            return "<img src='/uploads/$img' width='100px' height='50px' >";
        });
        $grid->type('Type')->display(function($type){
            return AdvertType::where('id',$type)->first()['name'];
        });
        $grid->url('Url');
        $grid->created_at('Created at')->sortable();
        
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
        $show = new Show(Advert::findOrFail($id));

        $show->id('Id');
        $show->img('Img');
        $show->type('Type');
        $show->url('Url');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Advert);

        $form->image('img', 'Img')->uniqueName()->rules('required');
        $form->select('type', '广告位')->options(AdvertType::all()->pluck('name', 'id'))->rules('required');
        $form->text('url', 'Url')->rules('required');

        $form->saved(function (Form $form) {
            $img = $form->model()->img;
            // if(session('url')=='create'){
                return redirect("/admin/attr/create?id=$id");
            // } 
        });

        return $form;
    }
}
