<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\ArticleType;

class ArticleController extends Controller
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
        $grid = new Grid(new Article);

        // 搜索设定
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('title', 'like', "%{$this->input}%")
                    ->orWhere('content', 'like', "%{$this->input}%");  
            }, '标题内容');
            $data = ArticleType::orderByRaw("CONCAT(path,id,'-') asc")->get();
            $params = [];
            $params[0] = "根级";
            foreach($data as $v)
            {   
                $str = str_repeat("&nbsp;&nbsp;",(count(explode('-',$v['path']))-2)*4);
                $params[$v['id']] = $str.$v['name'];
            }
            $filter->equal('type','类型')->select($params);
            $filter->between('created_at', '创建时间')->datetime(); 
        });


        $grid->id('Id');
        $grid->title('标题');
        $grid->type('文章类型')->display(function($type){
            return ArticleType::where('id',$type)->first()['name'];
        });
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
        $show = new Show(Article::findOrFail($id));

        $show->id('Id');
        $show->title('标题');
        $show->type('类型')->as(function ($type) {
            return ArticleType::where('id',$type)->first()['name'];
        });;
        $show->content('内容')->unescape();
        $show->created_at('Created at');
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);

        // 数据处理
        $data = ArticleType::orderByRaw("CONCAT(path,id,'-') asc")->get();
        $params = [];
        foreach($data as $v)
        {   
            $str = str_repeat("&nbsp;&nbsp;",(count(explode('-',$v['path']))-2)*4);
            $params[$v['id']] = $str.$v['name'];
        }

        $form->text('title', '标题')->rules('required');
        $form->image('img', '封面')->uniqueName()->rules('required');
        $form->select('type', '类型')->options($params)->rules('required');
        $form->editor('content', '内容')->rules('required');

        return $form;
    }
}
