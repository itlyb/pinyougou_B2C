<?php

namespace App\Admin\Controllers;

use App\Models\UserOrder;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\User;
use App\Models\Good;


class UserOrderController extends Controller
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
            ->header('订单管理')
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
        $grid = new Grid(new UserOrder);

        // 搜索设定
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('state','状态')->radio([
                 ''   => 'All',
                 0    => '未发货',
                 1    => '发货',
                 2    => '退款中',
                 3    => '已退款',
                 4    => '完成交易',
            ]);
            $filter->between('created_at', '创建时间')->datetime();
            $filter->like('address', '收货地址');
        });

        $grid->sn('订单编号');
        $grid->user_id('用户')->display(function($id){
            $user = User::where('id',$id)->first();
            $img = $user['img'];
            $phone = $user['phone'];
            return "<img src='/uploads/$img' width='50px' height='50px' style='border-radius:100px;' title='$phone' >";
        });
        $grid->good_id('商品')->display(function($id){
            return Good::where('id',$id)->first()['name'];
        });
        $grid->good_num('数量');
        $grid->money('钱数');
        $grid->address('送货地址'); 
        $grid->remarks('备注');
        $grid->state('状态')->radio([
            0 => '未发货',
            1 => '发货',
            2 => '退款中',
            3 => '已退款',
            4 => '完成交易',
        ]);
        
        $grid->created_at('Created at');

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
        $show = new Show(UserOrder::findOrFail($id));

        $show->user_id('User id');
        $show->good_id('Good id');
        $show->good_num('Good num');
        $show->money('Money');
        $show->address('Address');
        $show->state('State');
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
        $form = new Form(new UserOrder);
        $form->text('remarks', '备注');
        $form->text('express', '快递');
        $form->text('exp_num', '快递单号');
        $form->radio('state', 'State')->options([0 => '未发货', 1=> '发货', 2 => '退款中', 3 => '已退款', 4 => '完成交易'])->default(0);
        return $form;
    }
}
