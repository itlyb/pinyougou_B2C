<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
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
            ->header('用户管理')
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
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->img('头像')->display(function($img){
            return "<img src='/uploads/$img' width='50px' height='50px' style='border-radius:100px;' >";
        });
        $grid->phone('Phone');
        $grid->email('Email');
        $grid->level('Level');
        $grid->use_money('消费金额');
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 0, 'text' => '正常', 'color' => 'primary'],
            'off' => ['value' => 1, 'text' => '禁用', 'color' => 'default'],
        ];
        $grid->is_disable('是否禁用')->switch($states);
        
        // $grid->address('Address');
        // $grid->post_code('Post code');
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->phone('Phone');
        $show->email('Email');
        $show->password('Password');
        $show->level('Level');
        $show->use_money('Use money');
        $show->is_disable('Is disable');
        $show->address('Address');
        $show->post_code('Post code');
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
        $form = new Form(new User);

        $form->mobile('phone', 'Phone')->rules('required');
        $form->email('email', 'Email')->rules('required');
        $form->password('password', 'Password')->rules('required');
        $form->image('img','Img')->uniqueName()->rules('required');
        $form->number('level', 'Level');
        $form->decimal('use_money', 'Use money')->default(0.00);

        $form->switch('is_disable', 'Is disable');
        
        $form->text('address', 'Address');
        $form->text('post_code', 'Post code');

        return $form;
    }
}
