<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Browser;

use App\Models\LoginLog;
use App\Models\Dolog;

class LogController extends Controller
{
    // 登录 日志
    public function login_log($req)
    {
        // 获取用户的IP,设备,浏览器 
        $ip = $req->ip();
        $browser = Browser::browserName();
        	 
        if(Browser::isMobile())
        {
            $device = "Mobile";
        }
        else if(Browser::isTablet())
        {   
            $device = "Pad";
        }
        else if(Browser::isDesktop())
        {
            $device = "PC";
        }  
        // 把 log 存储在数据库中
        $loginlog = new Loginlog;
        $loginlog->makelog($ip,$browser,$device);
        
        // 把 log 存储在文件当中
        // $str = "ip: ".$ip.";browser: ".$browserName.";device: ".$device.";time: ".date("Y-m-d H:i:s");
        // return $str;
    }


    // 用户操作 日志信息
    public function do_log(Request $req)
    {
       $url =  $req->url();
       var_dump($url);
    }

    // 取出当日 top 10 
    public function top10()
    {
        $dolog = new Dolog;
        $top10 = $dolog->top10();
        dd($top10);
    }
    
    // 生成 Log 文件
    public function makeLog($content,$name,$path)
    {
        $fileName = Path."public/log/".$path."/".$name.".log";
        file_put_contents($fileName,$content.PHP_EOL,FILE_APPEND);
    }   
}

