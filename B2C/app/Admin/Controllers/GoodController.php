<?php

namespace App\Admin\Controllers;

use App\Models\Good;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\GoodType;
use App\Models\GoodBrand;
use App\Models\GoodSpec;
use DB;

class GoodController extends Controller
{
    use HasResourceActions;

    public static $url;
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品信息管理')
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
        session(['url' => 'edit']);
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
        session(['url' => 'create']);
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
        $grid = new Grid(new Good);
        
        // 搜索设定
        $grid->filter(function($filter){
            $filter->column(1/2, function ($filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->equal('is_shelf','是否上架')->radio([
                    ''   => 'All',
                    0    => '未上架',
                    1    => '已上架',
                ]);
                $filter->between('created_at', '创建时间')->datetime();
                $filter->where(function ($query) {
                    $query->where('name', 'like', "%{$this->input}%")
                        ->orWhere('little_name', 'like', "%{$this->input}%");  
                }, '标题名称');
            });
            $filter->column(1/2, function ($filter) {
                $data = GoodType::orderByRaw("CONCAT(path,id,'-') asc")->get();
                $params = [];
                $params[0] = "根级";
                foreach($data as $v)
                {   
                    $str = str_repeat("&nbsp;&nbsp;",(count(explode('-',$v['path']))-2)*4);
                    $params[$v['id']] = $str.$v['name'];
                }
                $filter->equal('type_id','类型')->select($params);
                $filter->equal('brand_id','品牌')->select(GoodBrand::all()->pluck('name', 'id'));
            });
            
        });

        $grid->id('Id')->sortable();
        $grid->name('名称');
        // $grid->little_name('副标题');
        $grid->img('封面')->display(function($img){
            return "<img src='/uploads/$img' width='100px' height='50px' >";
        });
        $grid->type_id('类型')->display(function($type){
            return GoodType::where('id',$type)->first()['name'];
        });
        $grid->brand_id('品牌')->display(function($brand){
            $img =  GoodBrand::where('id',$brand)->first()['img'];
            return "<img src='/uploads/$img' width='100px' height='50px' >";
        });
        $grid->is_shelf('是否上架')->display(function($shelf){
            if($shelf==1){return "已上架";} return "未上架";
        })->label();
        $grid->state('状态');
        $grid->column('数量')->display(function(){
            $num = DB::select("select sum(num) num from good_good_spus where good_id = ?",[$this->id]);
            return $num[0]->num;
        });
        $grid->created_at('添加时间')->sortable();

        // 添加按钮
        $grid->actions(function ($actions) {
            $id = $actions->getKey();
            $actions->append("&nbsp;<a href='/admin/attr?good_id=$id'><i class='fa'></i>属性</a>&nbsp;");
            $actions->append("<a href='/admin/spus?good_id=$id'><i class='fa'></i>单品</a>");
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
        $show = new Show(Good::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->little_name('Little name');
        $show->img('Img');
        $show->type_id('Type id');
        $show->type_pid('Type pid');
        $show->brand_id('Brand id');
        $show->is_shelf('Is shelf');
        $show->state('State');
        $show->good_num('Good num');
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
        $form = new Form(new Good);

        $form->tab('商品基本信息', function ($form) {
        
        // 数据处理
        $data = GoodType::orderByRaw("CONCAT(path,id,'-') asc")->get();
        $params = [];
        $params[0] = "根级";
        foreach($data as $v)
        {   
            $str = str_repeat("&nbsp;&nbsp;",(count(explode('-',$v['path']))-2)*4);
            $params[$v['id']] = $str.$v['name'];
        }

        
        $form->text('name', '商品名称')->rules('required');
        $form->text('little_name', '副标题')->rules('required');
        $form->image('img', '商品封面')->uniqueName()->rules('required');
        $form->select('type_id', '商品类型')->options($params)->rules('required');
        $form->hidden('type_pid', 'Type pid');
        $form->select('brand_id','品牌类型')->options(GoodBrand::all()->pluck('name', 'id'))->rules('required');
        $form->switch('is_shelf', '是否上架')->rules('required');
        $form->text('tags','商品关键字')->rules('required');
        $form->decimal('price', 'Price')->rules('required');
        $form->hidden('good_num', '商品数量')->default(0)->rules('required');
        $form->editor('description', '商品介绍')->rules('required');
        })
        ->tab('规格包装-售后保障', function ($form) {
            $form->editor('spec', '规格包装')->rules('required');
            $form->editor('after_sale', '售后保障')->rules('required');
        })
        ->tab('商品图片信息', function ($form) {
            // 添加删除按钮
            $form->hasMany('imgs', function (Form\NestedForm $form) {
                $form->image('img','商品图片')->uniqueName();
            });

        });

        $form->saving(function (Form $form) {
            $data = GoodType::where('id',$form->type_id)->first();
            $form->type_pid = $data['pid']; 
        });

        $form->saved(function (Form $form) {
            $id = $form->model()->id;
            if(session('url')=='create'){
                return redirect("/admin/attr/create?id=$id");
            } 
        });

        return $form;
    }
    
}
