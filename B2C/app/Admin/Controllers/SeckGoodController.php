<?php

namespace App\Admin\Controllers;

use App\Models\SeckillGood;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\Good;
use App\Models\SeckillType;
use App\Models\GoodType;
use App\Models\GoodBrand;

class SeckGoodController extends Controller
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
            ->header('秒杀商品管理')
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
        $grid = new Grid(new SeckillGood);

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
            });
            $filter->column(1/2, function ($filter) {
                $filter->equal('state','状态')->radio([
                    ''   => 'All',
                    1    => '有货',
                    2    => '已卖光',
                ]);
                $filter->equal('type','秒杀类型')->select(SeckillType::all()->pluck('name', 'id'));
            });
            
        });




        $grid->good_id('商品')->display(function($id){
            return Good::where('id',$id)->first()['name'];
        });
        $grid->price('价格')->sortable();
        $grid->num('数量')->sortable();
        $grid->type('秒杀类型')->display(function($type){
            return SeckillType::where('id',$type)->first()['name'];
        });
        $grid->is_shelf('是否上架')->display(function($shelf){
            if($shelf==1){return "已上架";} return "未上架";
        })->label();
        $grid->state('状态')->radio([
            1 => '有货',
            2 => '卖光',
        ]);
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
        $show = new Show(SeckillGood::findOrFail($id));

        $show->id('Id');
        $show->good_id('Good id');
        $show->price('Price');
        $show->num('Num');
        $show->type('Type');
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
        $form = new Form(new SeckillGood);
        
        $form->select('good_id','选择商品')->options(Good::all()->pluck('name', 'id'))->rules('required');
        $form->decimal('price', '价格')->rules('required');
        $form->number('num', '数量')->rules('required');
        $form->select('type', '秒杀类型')->options(SeckillType::all()->pluck('name', 'id'))->rules('required');
        $form->datetimeRange('start_time','end_time', '秒杀时间范围')->rules('required');
        $form->switch('is_shelf', '是否上架');
        $form->radio('state','状态')->options([1 => '有货', 2=> '卖光'])->default(0);
        return $form;
    }
}
