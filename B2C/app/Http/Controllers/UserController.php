<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserOrder;
use App\Models\Good;
use App\Models\GoodSpu;
use App\Models\GoodSpec;
use App\Models\UserFeet;
use App\Models\UserCollect;
use App\Models\User;
use App\Models\UserAddr;
use App\Models\UserComment;

use Alert;
use Cache;

class UserController extends Controller
{   
    // 订单列表-----------------------------------------
    // 所有订单
    public function home_index()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "index";
        return view('home.user.home-index',$data);
    }
    // 未发货
    public function home_unshipp()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->where('state',0)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "unshipp";
        return view('home.user.home-unshipp',$data);
    }
    // 发货
    public function home_shipp()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->where('state',1)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "shipp";
        return view('home.user.home-shipp',$data);
    }
    // 完成交易
    public function home_complete()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->where('state',4)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "complete";
        return view('home.user.home-complete',$data); 
    }
    // 退款中
    public function home_refuning()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->where('state',2)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "refuning";
        return view('home.user.home-refuning',$data);
    }
    // 已退款
    public function home_refund()
    {
        $id = session('users_id');
        $orders = UserOrder::where('user_id',$id)->where('state',3)->paginate(2);
        $data = $this->home_orders($orders);
        $data['hot_good'] = GuessController::hot_good();
        $data['url'] = "refund";
        return view('home.user.home-refund',$data);
    }

    // 跳转页面
    public function home_orders($orders)
    {   
        // dd($orders);
        $good = [];
        $sku = [];
        $spec = [];
        foreach($orders as $k => $v)
        {
            $good[$k] = Good::where('id',$v['good_id'])->first();
            $sku[$k] = GoodSpu::where('id',$v['spu_id'])->first();
            $specs = explode('-',$sku[$k]['path']);
            $str = "";
            foreach($specs as $v1)
            {
              if($v1!="")
              {
                $str .= GoodSpec::where('id',$v1)->first()['name']." ";
              }  
            }
            $spec[$k] = $str;
        } 
        return ['order'=>$orders,'good'=>$good,'sku'=>$sku,'spec'=>$spec];
    }

    // 订单评价
    public function home_order_comment(Request $req)
    {
        $user_id = session('users_id');
        $good_id = $req->good_id;
        $head_img = session('users_img');
        $user_name = session('user_name');
        $content = $req->content;
        $star = 5;
        $is_top = 0;
        $res = UserComment::insert([
            'user_id' => $user_id,
            'head_img' => $head_img,
            'user_name' => $user_name,
            'good_id' => $good_id,
            'star' => $star,
            'is_top' => $is_top,
            'content' => $content,
        ]);

        if($res)
        {   
            $order_id = $req->order_id;
            UserOrder::where('id',$order_id)->update([
                'is_comment' => 1,
            ]);
            Alert::success('评论成功，谢谢您对我们的支持！');
            return back();
        }

        
        
    }




    // 浏览收藏----------------------------------
    // 我的足迹
    public function home_foot()
    {   
        $user_id = session('users_id');
        $foot = UserFeet::where('user_id',$user_id)->orderBy('created_at','>=','now()')->take(20)->get();
        $good = [];
        foreach($foot as $k => $v)
        {
            $good[$k] = Good::where('id',$v['good_id'])->first();
        }
        return view('home.user.home-footmark',['good'=>$good,'foot'=>$foot,'url'=>'foot']);
    }
    // 我的收藏
    public function home_collect() // 收藏显示
    {   
        $user_id = session('users_id');
        $collect = UserCollect::where('user_id',$user_id)->get();
        $good = [];
        $sku = [];
        foreach($collect as $k => $v)
        {
            $good[$k] = Good::where('id',$v['good_id'])->first();
            $sku[$k] = GoodSpu::where('good_id',$good[$k]['id'])->first()['id'];
        }
        $hot_good = GuessController::hot_good();
        return view('home.user.home-collect',['good'=>$good,'collect'=>$collect,'url'=>'collect','sku'=>$sku,'hot_good'=>$hot_good]);
    }
    public function home_collect_delete(Request $req) // 收藏删除
    {
        $user_id = session('users_id');
        $id = $req->id;
        $res = UserCollect::where('user_id',$user_id)->where('id',$id)->first();
        if($res)
        {
            UserCollect::where('id',$id)->delete();
            Alert::success('取消收藏成功');
            return back();
        }
        Alert::success('没有权限!IP已被跟踪。。。');
        return back();
    }
    public function home_do_collect(Request $req) // 点击收藏
    {   
        $user_id = session('users_id');
        $good_id = $req->good_id;
        $res = UserCollect::where('good_id',$good_id)->where('user_id',$user_id)->first();
        if($res)
        {
            Alert::warning('已经收藏了哦！');
            return back();
        }
        $res = UserCollect::insert([
            'user_id' => $user_id,
            'good_id' => $good_id,
        ]);
        if($res)
        {   
            Alert::success('收藏成功');
            return back();
        }
    }



    // 个人信息修改--------------------------------
    public function home_info()
    {   
        $user_id = session('users_id');
        $info = User::where('id',$user_id)->first();
        return view('home.user.home-info',['info'=>$info,'url'=>'info']);
    }
    public function home_info_base(Request $req)
    {
        $user_id = session('users_id');
        $name = $req->name;
        $sex = $req->sex;
        $birthday = $req->year."-".$req->month."-".$req->day;
        $address = $req->province."-".$req->city."-".$req->district;
        
        // dd($sex);
        $res = User::where('id',$user_id)
            ->update([
                'name' => $name,
                'sex' => $sex,
                'birthday' => $birthday,
                'address' => $address,
                
            ]);
        if($res){
            session(['user_name'=>$name]);
            Alert::success('修改成功');
            return back();
        }
    }
    public function home_info_img(Request $req)
    {   
        $user_id = session('users_id');
        if($req->has('img') && $req->img->isValid())
        {
            $date = date('Ymd');
            $img = $req->img->store('img/'.$date);
        }
        $res = User::where('id',$user_id)->update([
            'img' => $img
        ]);
        if($res){
            session(['users_img'=>$img]);
            Alert::success('头像修改成功！');
            return back();
        }
        Alert::warning('头像修改失败！');
        return back();
    }



    // 收货地址-------------------------------------
    public function home_address()
    {   
        $user_id = session('users_id');
        $address = UserAddr::where('user_id',$user_id)->get();
        // dd($address);
        return view('home.user.home-address',['url'=>'address','address'=>$address]);
    }
    public function home_address_set(Request $req)
    {
        $user_id = session('users_id');
        $name = $req->name;
        $address1 = $req->province."-".$req->city."-".$req->district;
        $address2 = $req->address;
        $phone = $req->phone;
        
        $res = UserAddr::insert([
            'user_id' => $user_id,
            'name' => $name,
            'address' => $address1,
            'address_more' => $address2,
            'phone' => $phone,
        ]);

        if($res)
        {
            Alert::success('地址添加成功！');
            return back();
        }

        Alert::warning('地址添加失败！');
        return back();
    }
    public function home_address_use(Request $req)
    {
        $id = $req->id;
        $user_id = session('users_id');
        $res1 = UserAddr::where('user_id',$user_id)
            ->update([
                'is_use' => 0
            ]);
        $res2 = UserAddr::where('id',$id)
            ->update([
                'is_use' => 1
            ]);
        if($res1 && $res2)
        {
            Alert::success('设置成功！');
            return back();
        }
        Alert::warning('设置失败！');
        return back();
    }
    public function home_address_delete(Request $req)
    {
        $id = $req->id;
        $user_id = session('users_id');
        $res = UserAddr::where('user_id',$user_id)
                ->where('id',$id)
                ->first();

        if(!$res)
        {   
            Alert::warning('无权操作！IP已被追踪。。。');
            return back();
        }
        
        $res = UserAddr::where('id',$id)->delete();
        if($res)
        {
            Alert::success('删除地址成功！');
            return back();
        }

        Alert::warning('删除失败！');
        return back();

    }
    public function home_address_edit(Request $req)
    {
        $user_id = session('users_id');
        $name = $req->name;
        $address1 = $req->province."-".$req->city."-".$req->district;
        $address2 = $req->address;
        $phone = $req->phone;
        $id = $req->id;


        $res = UserAddr::where('user_id',$user_id)
            ->where('id',$id)
            ->update([
                'user_id' => $user_id,
                'name' => $name,
                'address' => $address1,
                'address_more' => $address2,
                'phone' => $phone,
            ]);
            
        if($res)
        {
            Alert::success('修改成功！');
            return back();
        }
        Alert::warning('设置失败！');
        return back();
    }

    // 安全管理------------------------------
    public function home_safe()
    {   
        $user_id = session('users_id');
        $user = User::where('id',$user_id)->first();
        return view('home.user.home-safe',['url'=>'safe','user'=>$user]);
    }
    public function home_safe_password(Request $req)
    {
        $user_id = session('users_id');
        $password = md5($req->password);
        $res = User::where('id',$user_id)
            ->update([
                'password' => $password
            ]);
        if($res)
        {
            Alert::success('密码修改成功！');
            return back();
        }
        Alert::warning('密码修改失败！');
        return back();
    }
    public function home_safe_first(Request $req)
    {
        $code = $req->msgcode;
        if(Cache::get('duanxin') != $code)
        {
            Alert::warning('手机验证码错误')->persistent("Close");
            return back()->withInput();          
        }
        return redirect('/home_safe_second');
    }
    public function home_safe_second()
    {
        return view('home.user.home-safe-2');
    }
    public function home_safe_second_sub(Request $req)
    {
        $user_id = session('users_id');
        $code = $req->msgcode;
        $phone = $req->phone;
        if(Cache::get('duanxin') != $code)
        {
            Alert::warning('手机验证码错误')->persistent("Close");
            return back()->withInput();          
        }

        $res = User::where('id',$user_id)
            ->update([
                'phone' => $phone
            ]);
            
        if($res){
            return redirect('/home_safe_third');
        }

        
    }
    public function home_safe_third()
    {
        return view('home.user.home-safe-3');
    }
    
}
