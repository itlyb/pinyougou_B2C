<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodSpu;
use App\Models\GoodSpec;
use App\Models\GoodImg;
use App\Models\UserCart;
use App\Models\GoodType;
use App\Models\UserComment;
use App\Models\GoodBrand;
use App\Models\UserAddr;
use App\Models\UserOrder;
use App\Models\Article;

use App\Models\Predis;

use DB;

use Alert;

class GoodController extends Controller
{      
    // 商品单品显示----------------------------------------------------------------------------
    // 单品显示页
    public function item(Request $req)
    {   
        // 获取商品id
        $id = $req->id;

        // 获取商品信息
        $good = Good::where('id',$id)->first();
        // 如果寻找商品不存在
        if(!$good)
        {
            Alert::warning("对不起,你选择的商品不存在！");
            return redirect('/');     
        }
        // 获取商品类别
        $type_id =  $good['type_id'];
        $type = GoodType::where('id',$type_id)->first()['name'];
        // 获取商品单品
        $spu = GoodSpu::where('good_id',$id)->get();
        // 获取商品图片
        $img = GoodImg::where('good_id',$id)->get();
        // 获取商品属性
        $attr = GoodAttr::where('good_id',$id)->get();
        // 获取商品属性值
        $spec = [];
        foreach($attr as $v)
        {
            $spec[$v['name']] = GoodSpec::where('attr_id',$v['id'])->get();
        }
        // 获取单品属性值种类数据
        $specs = [];
        foreach($spu as $v)
        {
            $data = explode('-',$v['path']);
            $specs = array_merge($specs, $data);
        }
        $specs = array_unique($specs);
        // 获取单品选中单品属性值信息
        $spus = session("path_$id");  
        // 如果没有单品信息就采用默认单品信息
        if(!$spus)
        {   
            $spu = $spu[0];// 获取单品信息
            $spus = explode('-',$spu['path']); // 获取单品属性值数组
        }
        else
        {   
            $spu = GoodSpu::where('path',$spus)->first(); // 获取单品信息
            $spus = explode('-',$spus);  // 获取单品属性值信息
        }
        // 获取商品评论信息
        $comment = UserComment::where('good_id',$good['id'])->get();
        // 获取推荐商品分类
        $goodType= GoodType::where('id',$good['type_id'])->first();// 取出商品类型信息
        $good_type = GoodType::where('pid',$goodType['pid'])->get(); 
        // 获取推荐品牌
        $type_name = $goodType['name'];
        $brand = GoodBrand::search($type_name)->get();
        // 猜你喜欢
        $like_good = GuessController::guess_you_like();


        // 跳转页面到商品信息页
        return view('home.good.item',[
            'good'=>$good,'type'=>$type,'attr'=>$attr,
            'spec'=>$spec,'spu'=>$spu,'img'=>$img,
            'specs'=>$specs,'spus'=>$spus,'comment'=>$comment,
            'brand'=>$brand,'good_type'=>$good_type,
            'like_good'=>$like_good
            ]);

    }
    // 单品选择-跳转方法
    public function spus(Request $req)
    {   
        // 取出传输的 spu 
        $data = $req->spus;
        $path = "";
        foreach($data as $v)
        {
            $path .= $v."-";
        }

        // 获取传输的商品id,保存在 session 中
        $id = $req->good_id;
        session(["path_$id"=>$path]);

        // 获取选择的单品
        $spu = GoodSpu::where('path',$path)->first();
        if(!$spu || $spu['num'] == 0){
            Alert::warning("对不起,你选择的款式已卖光！");
        }

        // 跳转页面
        return redirect("/item?id=$req->good_id");
    }




    // 购物车----------------------------------------------------------------------------------
    // 购物车提交
    public function good_car(Request $req)
    {   
        // 获取 单品 id
        $id = $req->spu_id;
        
        // 获取单品数量
        $num = $req->num ? $req->num : 1;

        // 获取选择的单品
        $spu = GoodSpu::where('id',$id)->first();

        // 如果单品不存在或者数量为零，就跳转回去
        if(!$spu || $spu['num'] == 0){
            Alert::warning("对不起,你选择的款式已卖光！");
            return back();
        }

        // 获取单品信息
        $spu = GoodSpu::where('id',$id)->first();
        $money = $num * $spu['price'];
        $user_id = session('users_id');
        $good_name = Good::where('id',$spu['good_id'])->first()['name'];

        // 判断购物车中是否有此单品的订单
        $res = UserCart::where('user_id',$user_id)->where('spu_id',$spu['id'])->first();

        if(!$res)
        {
            // 插入购物车表
            UserCart::insert([
                'user_id' => $user_id,
                'good_id' => $spu['good_id'],
                'good_name' => $good_name,
                'spu_id'  => $id,
                'good_num' => $num,
                'money' => $money,
            ]);
        }
        else
        {
            UserCart::where('id',$res['id'])
                ->update([
                    'good_num' => $res['good_num']+$num,
                    'money' => $money+$res['money'],
                ]);   
        }
        
        
        // 更改购物车数量
        $good_cart_num = UserCart::where('user_id',session('users_id'))->count();
        session(['good_cart_num'=>$good_cart_num]);


        Alert::success("加入购物车成功！");
        return back();
    }
    // 购物车跳转
    public function good_cart(Request $req)
    {   
        $user_id = session('users_id'); // 获取用户id
        $key = $req->keyword; // 获取搜索信息
        if(!$key) // 如果搜索信息不存在
        {
            $good_cart = UserCart::where('user_id',$user_id)->get();  
        }
        else
        {   
            $good_cart = UserCart::search($key)
                     ->where('user_id',$user_id)
                     ->get();
        }
        
        $good = []; // 商品
        $sku = [];  // 单品
        $spec = []; // 属性值
        foreach($good_cart as $k => $v)
        {
            $good[$k] = Good::where('id',$v['good_id'])->first(); // 获取商品信息
            $sku[$k]  = GoodSpu::where('id',$v['spu_id'])->first(); // 获取对应单品信息
            $specs = explode('-',$sku[$k]['path']); // 属性值数组
            $str = "";
            foreach($specs as $v1)
            {
                if($v1!=""){
                    $str .= GoodSpec::where('id',$v1)->first()['name']." ";
                }
            }
            $spec[$k] = $str; // 保存购物车单品的属性值名称
        }
        // 获取猜你喜欢
        $good_you_like = GuessController::guess_you_like();
        // 跳转购物车页面
        return view('home.good.cart',[
            'good_cart'=>$good_cart,
            'sku'=>$sku,'spec'=>$spec,
            'good'=>$good,
            'good_you_like'=>$good_you_like
            ]);
    }
    // 购物车 ajax 修改购物车信息接口
    public function good_cart_ajax(Request $req)
    {
        $id = $req->id; // 获取购物车信息id
        $type = $req->type; // 获取操作行为种类（增加数量/删除/减少/输入框修改）
        $money = $req->money; // 获取钱数
        $cart = UserCart::where('id',$id)->first(); // 获取购物车单品信息
        // 如果是添加数量
        if($type == "add") 
        {
            $res = UserCart::where('id',$id)
            ->update([
                'good_num' => $cart['good_num']*1 + 1,
                'money' => $cart['money'] + $money,
            ]);
            echo $res;
        }
        // 如果是减少数量
        if($type == "delete")
        {
            $res = UserCart::where('id',$id)
            ->update([
                'good_num' => $cart['good_num']*1 - 1,
                'money' => $cart['money'] - $money,
            ]);
            echo $res;
        }
        // 如果是修改输入框 产品数量
        if($type == "any")
        {
            $res = UserCart::where('id',$id)
            ->update([
                'good_num' => $req->num,
                'money' => $money,
            ]);
            echo $res;   
        }
        
    }
    // 购物车删除
    public function good_cart_delete(Request $req)
    {
        $id = $req->cart_id; 
        UserCart::where('id',$id)->delete();
        // 更改购物车数量
        $good_cart_num = UserCart::where('user_id',session('users_id'))->count();
        session(['good_cart_num'=>$good_cart_num]);
        // 返回页面
        Alert::success('删除成功,已从购物车中移除！');
        return back();
    }
    // 购物车搜索
    public function good_cart_search(Request $req)
    {
        $key = $req->keyword;
        $good_cart = UserCart::search($key)
                     ->where('user_id',session('users_id'))
                     ->get();
        
    }

    // 订单付款--------------------------------------------------------------
    // 获取订单信息
    public function get_order_info(Request $req)
    {   
        // 获取购物车 id
        $good_carts = $req->good_carts;
        // 如果没有勾选商品则返回表单
        if(!$good_carts)
        {
            Alert::warning('品优购提醒您：请选择付款商品！');
            return back();
        }
        // 保存勾选订单信息
        session(['orders'=>$good_carts]);        
        // 跳转订单信息确认页面
        return redirect('/get_order_info');
    }
    // 订单信息确认页面
    public function get_order_info2()
    {   
        $good_carts = session('orders');
        // 获取购物车信息
        $good_carts = UserCart::whereIn('id',$good_carts)->get();
        // 获取单品信息
        $sku_good_has = []; // 有货数量充足
        $sku_good_num = []; // 有货数量不足
        $sku_good_no  = []; // 没有货单品
        $good = []; // 获取商品信息
        $money = 0; // 设置钱数为 0
        foreach($good_carts as $k => $v)
        {
            $data = GoodSpu::where('id',$v['spu_id'])->first(); // 获取单品信息
            $good[$k] = Good::where('id',$data['good_id'])->first(); // 获取商品信息
            
            // 如果单品数量不为 0
            if($data['num'] != 0)
            {
                if($v['good_num'] > $data['num']) // 如果购买数量大于单品数量 （数量不足，买不了）
                {
                    $sku_good_num[$k] = $data;
                }
                else                             // 如果购买数量小于单品数量 （可以购买）
                {
                    $sku_good_has[$k] = $data; 
                    $money += $v['money'];
                }
            }
            else
            {
                $sku_good_no[$k] = $data;        // 如果数量为零 （卖光了）
            }
            
        }
        // 获取地址信息
        $user_id = session('users_id');
        $address = UserAddr::where('user_id',$user_id)->get();
        // 把数据传输过去
        return view('home.good.getorderinfo',[
            'sku_good_has' => $sku_good_has,
            'sku_good_no' => $sku_good_no,
            'sku_good_num' => $sku_good_num,
            'good_cart' => $good_carts,
            'address' => $address,
            'good'=>$good,
            'money' => $money
        ]); 
    }

    // 付款-------->>>>>>>>
    public function pay(Request $req)
    {   
        // 连接 redis
        $redis = Predis::getInstance(); 
        // 获取 cart id
        $cart_id = $req->cart_id;
        if(!$cart_id){
            Alert::warning('商品数量不足，请调整购物车商品信息！');
            return back();
        }

        // 保存 cart_good 信息
        $cart_good = [];
        // 获取购物车的订单信息
        foreach($cart_id as $k => $v)
        {   
            $cart_good[$k] = UserCart::where('id',$v)->first(); 
        }
        
        // 保存每次对单品数量的修改
        $sku_num = [];
        $sku_id = [];
        // 获取单品信息
        foreach($cart_good as $k => $v)
        {   
            $sku = GoodSpu::where('id',$v['spu_id'])->first();
            // 判断 redis 中有没有保存 单品数量 信息 （有就跳过，没就保存）
            if(!$redis->hexists ('sku_num',"sku_".$sku['id']))
            {
                $redis->hset('sku_num','sku_'.$sku['id'],$sku['num']);
            }
            // 获取减去订单数量之前的单品数量
            $sku_num[$k] = $v['good_num'];
            $sku_id[$k] = $sku['id'];
            // 获取减去订单数后的单品数量
            $num = $redis->hincrby('sku_num','sku_'.$sku['id'],-$v['good_num']);
            // 判断商品数是否足够
            if($num < 0)
            {   
                // 如果商品数量不足够那么就把减去的商品数量值加回去
                foreach($sku_num as $k => $v)
                {
                    $redis->hincrby('sku_num','sku_'.$sku_id[$k],$v);
                }
                // 退出订单付款，告诉客户商品数量不足，需要调整
                Alert::warning($sku['id']."号商品数量不足，请调整购物车商品数量重新购买！");
                return back();
            }
        }

            
    
        // 如果商品数量都充足，那么就下订单，开启事务
        DB::beginTransaction();

            $user_id = session('users_id');// 用户 id
            $addr = UserAddr::where('user_id',$user_id)->where('is_use',1)->first()['id']; // 订单地址
                
            $money = 0; // 总钱数
            $sns = md5($user_id.date('H:i:s'));  // 订单号组
            
            foreach($cart_good as $k => $v)
            {   
                // 生成订单编号
                $sn = md5($user_id.date('H:i:s').$v['id']);
                // 生成订单 
                $res = UserOrder::insert([
                    'sn' => $sn,
                    'sns' => $sns,
                    'user_id' => $user_id,
                    'good_id' => $v['good_id'],
                    'spu_id' => $v['spu_id'],
                    'good_num' => $v['good_num'],
                    'money' => $v['money'],
                    'address' => $addr,
                ]);

                
                // 如果执行失败就 回滚 事务   
                if(!$res){
                    DB::rollback();
                }
                // 计算总钱数
                $money += $v['money'];
            } 
        // 如果全部执行成功就提交事务
        DB::commit();   
        // 获取微信付款 二维码 
        $code = WxpayController::pay($money,$sns);
        // 保存付款信息到 session 中
        session(['user'.$user_id."_pay"=>[
            'sns' => $sns,
            'money' => $money,
            'code' => $code,
        ]]);
        // 跳转到支付页面
        return redirect('/pay_view');

    }

    // 支付页面
    public function pay_view(Request $req)
    {   
        $user_id = session('users_id'); // 获取用户 id
        $pay = session('user'.$user_id."_pay"); // 获取支付信息
        return view('home.good.pay',['pay'=>$pay]); // 跳转页面
    }

    public function orderStatus(Request $req)
    {
        $sns = $req->sn;
        $is_pay = UserOrder::where('sns',$sns)->first()['is_pay'];
        if($is_pay == 1)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }



    // 商品文章-------------------------------------------------------------------------------------------
    public function article(Request $req)
    {
        $id = $req->id; // 获取文章 id
        $article = Article::where('id',$id)->first(); // 获取文章内容
        if(!$article)
        {
            return back();
        }
        return view('home.good.article',[ 
            'article' => $article
        ]);
    }
    
}
