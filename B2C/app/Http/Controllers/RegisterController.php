<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CheckRegister;

use App\Models\Duanxin;

use Illuminate\Support\Facades\Cache;

use Alert;

use Redirect;

use App\Models\User;

class RegisterController extends Controller
{
    public function register_before()
    {
        return view('home.user.register');
    }

    public function do_register(CheckRegister $req)
    {   
        $user = User::where('name',$req->name)->first();
        $phone = User::where('phone',$req->phone)->first();
        if($user)
        {
            Alert::warning('用户名重复')->persistent("Close");
            return back()->withInput();   
        } 
        if($phone)
        {
            Alert::warning('手机号重复')->persistent("Close");
            return back()->withInput();   
        } 
        if(Cache::get('duanxin')!=$req->phone_code)
        {
            Alert::warning('手机验证码错误')->persistent("Close");
            return back()->withInput();          
        }

        User::insert([
            'name' => $req->name,
            'password' => md5($req->password),
            'phone' => $req->phone,
        ]);

        Alert::success('注册成功')->persistent("Close");
        return redirect('/login_before');
        
    }

    public function duanxin(Request $req)
    {   
        $phone = $req->phone;
        Duanxin::index($phone);
    }
}
