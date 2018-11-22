<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Good;
use App\Models\GoodBrand;
use App\Models\SearchAttr;
use App\Models\SearchSpec;
use App\Models\GoodSpu;
use App\Models\UserComment;
use App\Models\UserOrder;
use DB;


class SearchController extends Controller
{   
    // 搜素框单条数据搜索
    public function search(Request $req)
    {   
        // 获取搜索框的值
        $key = $req->keyword;
        
        // 获取搜索属性
        if($key != session('keyword'))
        {
            session(['attr'=>""]);
        }

        if($req->attr_name)
        {   $data = [];
            foreach(session('attr') ? session('attr') : [] as $k => $v)
            {
              $data[$k] = $v;  
            }
            $data[$req->attr_name] = $req->attr_value;
            session(['attr'=>$data]);
        }

        if($req->delete_attr)
        {   
            $data = [];
            foreach(session('attr') as $k => $v)
            {   
               if($k == $req->delete_attr)
               {
                    continue;
               }
               $data[$k] = $v;
            }
            session(['attr'=>$data]);
        }
        
        // dd(session('attr'));die;
        // 如果搜索框没有传值
        if($key == '')
        {
            return back();
        }

        
        session(['keyword'=>$key]);

        return redirect('/search_view');
    }   

    // 防止表单重复提交
    public function search_view(Request $req)
    {   
        $key = session('keyword');
        // 搜索条件
        $req_attr = session('attr');
        $attrs = []; // 获取搜索条件
        if($req_attr)
        {   
            foreach($req_attr as $k => $v)
            {
                $key .= $k.$v;
                $attrs[$k] = $v;
            }
        }
        
        // dd($req->order_way);
        // 执行搜索获取数据
        // 搜索商品
        $goods = Good::search($key)->get();
        // dd($goods);
        $ids = [];
        $commentsId = [];
        $ordersId = [];
        foreach($goods as $v)
        {
            $ids[] = $v['id'];
            $commentsId[$v['id']] = UserComment::where('good_id',$v['id'])->count();
            $ordersId[$v['id']] = UserOrder::where('good_id',$v['id'])->count(); 
        }
        arsort($commentsId);
        arsort($ordersId);
        // dd($commentsId,$ordersId);
        $good = Good::whereIn('id',$ids)->paginate(1);
        

        // dd($good);die;
        if($req->orderBy)
        {   
            if($req->orderBy == "num")
            {
                $good_id = [];
                foreach($ordersId as $k => $v)
                {
                    $good_id[] = $k;
                }
                $good = Good::whereIn('id',$good_id)->paginate(1);
            }
            if($req->orderBy == "time")
            {   
                $good = Good::whereIn('id',$ids)->orderBy('created_at','desc')->paginate(1);
            }
            if($req->orderBy == "comment")
            {
                // $sql = 'SELECT count(*) num,g.id from good_goods g LEFT JOIN good_user_comments c on g.id = c.good_id group by g.id ORDER BY num desc';
                // $good = DB::select($sql);
                $good_id = [];
                foreach($commentsId as $k => $v)
                {
                    $good_id[] = $k;
                }
                $good = Good::whereIn('id',$good_id)->paginate(1);
            }
            if($req->orderBy == "price")
            {   
                $order_way = session('price') ? session('price') : session(['price'=>'desc']);
                if($order_way == "desc"){$order_way = 'asc';session(['price'=>'asc']);}else{$order_way = 'desc';session(['price'=>'desc']);}
                $good = Good::whereIn('id',$ids)->orderBy('price',$order_way)->paginate(1);
            }
        }

        // 获取商品单品价格 和 评论数
        $skus  = [];
        $comment_num = [];
        foreach($good as $k => $v)
        {
            $sku = GoodSpu::where('good_id',$v['id'])->first();
            $skus[$v['name']] = $sku;
            $comment_num[$v['name']] = UserComment::where('good_id',$v['id'])->count();
        }

        // 搜索品牌
        $brand = GoodBrand::search($key)
                ->get();
        
        // 搜索属性
        $attr = SearchAttr::search($key)
                ->get();

        // 搜索属性值
        $attr_value = [];
        foreach($attr as $k => $v)
        {
            $data = SearchSpec::where('attr_id',$v['id'])->get();
            $attr_value[$v['name']] = $data;
        }
        
        // dd($good,$brand,$attr,$attr_value);die;

        // 跳转到搜索页并传递数据
        return view('home.good.search',['keyword'=>$key,'good'=>$good,'brand'=>$brand,'attr'=>$attr,'attr_value'=>$attr_value,'skus'=>$skus,'comment_num'=>$comment_num,'attrs'=>$attrs,'orderBy'=>$req->orderBy]);
    }


    // 品牌，种类，规格。。多条件搜索
    public function search_many(Request $req)
    {   
        // 定义搜索条件为空
        $key = "";
        // 如果xxx
        if(isset($req->xxx))
        {

        }
    }

    public function search_attr(Request $req)
    {   

        return redirect('/search_view');
    }

}
