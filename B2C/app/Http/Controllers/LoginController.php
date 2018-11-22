<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Alert;

use Cookie;

use App\Models\UserCart;

class LoginController extends Controller
{   
    
    // 显示登录页面
    public function login_before(Request $req)
    {   

        
        if(isset($_COOKIE['name']))
        {   
            $value = $_COOKIE['name'];
            $user = User::where('name',$value)->first();
            $good_cart_num = UserCart::where('user_id',$user['id'])->count();
            session(['user_name'=>$value]);
            session(['users_id'=>$user['id']]);
            session(['user_phone'=>$user['phone']]);
            session(['users_img'=>$user['img']]);
            session(['good_cart_num'=>$good_cart_num]);
            Alert::success('欢迎回来！');
            return redirect('/');
        }
        
        return view('home.user.login');
    }

    // 提交登录表单
    public function do_login(Request $req)
    {   
        // 获取根据传值获取用户名
        $name = User::where('name',$req->name)->first()['name']; 
        $phone = User::where('phone',$req->name)->first()['name'];
        // 获取输入密码
        $password = md5($req->password);
        // 定义搜寻结果为 null
        $res = null;
        // 如果是用户名登录
        if($name)
        {   
            $res = User::where('name',$name)->where('password',$password)->first();
        }
        // 如果是手机号登录
        if($phone)
        {
            $res = User::where('name',$phone)->where('password',$password)->first();
        } 
        // 如果用户名和密码都正确
        if($res){

            // 获取用户购物车商品数量
            $good_cart_num = UserCart::where('user_id',$res['id'])->count();
          
            // 保存用户名和id 到 session 中
            session(['user_name'=>$res['name']]);
            session(['users_id'=>$res['id']]);
            session(['user_phone'=>$res['phone']]);
            session(['users_img'=>$res['img']]);
            session(['good_cart_num'=>$good_cart_num]);

            // 如果勾选了记住密码
            if($req->m1 == 2)
            {   // 把用户信息保存到 Cookie 中
                setcookie("name", $res['name'], time()+3600*1);
            }

            // 保存登录日志
            $log = new LogController;
            $log->login_log($req);
            
            // 跳转页面
            Alert::success('登录成功');
            return redirect('/');        
        }
        
        // 如果用户提交信息错误
        Alert::warning('账号或密码错误')->persistent("Close");
        return back();
    }

    // 退出登录
    public function logout(Request $request)
    {   
        // 删除 session 信息
        $request->session()->flush();
        // 跳转登录
        return redirect()->route('login_before');
    }
}
