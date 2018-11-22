<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yansongda\Pay\Pay;
use Endroid\QrCode\QrCode;

use App\Models\UserOrder;

use DB;

class WxpayController extends Controller
{
    protected static $config = [
        'app_id' => 'wx426b3015555a46be', // 公众号 APPID
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        'notify_url' => 'http://596bddbe.ngrok.io/notify',
    ];

    public static function pay($money,$sns)
    {       

        $ret = Pay::wechat(self::$config)->scan([
            'out_trade_no' => $sns,
            'total_fee' => 1, 
            'body' => '购买商品金额：',
        ]);
        
        if($ret['return_code'] == 'SUCCESS' && $ret['result_code'] == 'SUCCESS')
        {   
            return $ret['code_url']; 
        } 
    }

    public function notify()
    {   

        $pay = Pay::wechat(self::$config);

        try{
            $data = $pay->verify(); // 是的，验签就这么简单！
            
            if($data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS')
            {
                
                $orderInfo = UserOrder::where('sns',$data->out_trade_no)->get();

                // 开启事务
                DB::beginTransaction();

                foreach($orderInfo as $k => $v)
                {   
                    $res = UserOrder::where('id',$v['id'])->update([
                        'is_pay' => 1
                    ]);

                    if(!$res){
                        DB::rollback();
                    }
                }

                DB::commit();   
                

            }

        } catch (Exception $e) {
            dd( $e->getMessage() );
        }
        
        $pay->success()->send();
    }

    // 生成二维码
    public function qrcode($code)
    {
        $qrCode = new QrCode($code);
        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }

    // 退款
    public static function refund()
    {
        $order = [
            'out_trade_no' => '91ceff67b5730135445963cc27a37902',
            'out_refund_no' => 1,
            'total_fee' => '1',
            'refund_fee' => '1',
            'refund_desc' => '测试退款haha',
        ];
        
        $wechat = Pay::wechat(self::$config);
        
        $result = $wechat->refund($order);

        dd($result);
    }
}
