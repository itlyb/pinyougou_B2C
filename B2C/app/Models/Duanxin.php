<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Qcloud\Sms\SmsSingleSender;

use Illuminate\Support\Facades\Cache;

class Duanxin extends Model
{   
    public static function index($phone)
    {   
        //短信应用SDK AppID 
        $appid  =  1400155547 ; // 1400开头

        //短信应用SDK AppKey 
        $appkey  =  "7fcf7a325f1b0f472e683cc41809bb7c";

        //需要发送短信的手机号码
        $phoneNumbers  = [$phone];

        //短信模板ID，需要在短信应用中申请
        $templateId  =  216751 ;   // NOTE:这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign  =  "码上分享" ; // NOTE:这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        

        $code = mt_rand(1000,9999);

        Cache::put('duanxin',$code,1);

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [$code,"1"];
            $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }

        
   
        

    }
}
