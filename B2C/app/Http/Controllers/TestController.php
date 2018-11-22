<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Duanxin;

use Alert;
use Redirect;
use Elasticsearch;
use App\Models\Good;
use App\Models\GoodType;

use App\Models\Predis;

use DB;

use Pay;

use App\Jobs\ProcessPodcast;


class TestController extends Controller
{   

    // 插入分类数据
    public function add_types()
    {   

        $arr = explode(',','投影机,投影配件,多功能一体机,打印机,传真设备验钞/点钞机扫描设备,复合机,碎纸机,考勤门禁,收银机,会议音频视频,保险柜装订/封装机,安防监控,办公家具,白板');
        $pid = 210;
        $path = "-155-".$pid."-";

        foreach($arr as $k => $v)
        {
            GoodType::insert([
                'name' => $v,
                'pid'  => $pid,
                'path' => $path,
            ]);
        }

    }








    protected $config = [
        'app_id' => 'wx426b3015555a46be', // 公众号 APPID
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        'notify_url' => 'lyb18.com',
    ];

    public function imgsearch()
    {
       $data = ImgSearchController::ImgSearch('E:\timg.jpg');
       return $data;
    }
    public function refund()
    {
        WxpayController::refund();
    }
    public function list()
    {   
        $good = new Good;
        ProcessPodcast::dispatch();
        // ProcessPodcast::dispatch()
            // ->delay(now()->addMinutes(1));
    }

    public function fenli()
    {
        return Good::get();
    }


    public function code(Request $req)
    {   
        dd(1);
        return view('test.index',['code'=>$req->code]);
    }
    public function pay()
    {
        

        $order = [
            'out_trade_no' => 2,
            'body' => 'subject-测试',
            'total_fee'      => '1',
            'openid' => 'onkVf1FjWS5SBIixxxxxxxxx',
        ];
        
        $result = Pay::wechat()->mp($order);
    }
    public function shiwu()
    {
        DB::transaction(function () {
            for($i=0;$i<=100000;$i++){
                Good::where('id',65)->update([
                    'little_name' => 'hahacuole'
                ]);
            }
        });
    } 
    public function predis()
    {
        $redis = Predis::getInstance();

        if(!$redis->hexists ('sku_num','sku_1'))
        {
            $redis->hset('sku_num','sku_1',30);
        }

        $num = $redis->hincrby('sku_num','sku_1',-3);

        if($num >= 0)
        {
            dd($num);
        }
        else
        {   
            $redis->hincrby('sku_num','sku_1',3); 
            dd('卖没了');     
        }
        
    }
    public function elastic()
    {   
        $data = Good::get();
        foreach($data as $k => $v)
        {
            $data = [
                'body' => [
                    'name' => $v['name'],
                    'little' => $v['little_name']
                ],
                'index' => 'good',
                'type' => 'goods',
                'id' => $v['id'],
            ];
            Elasticsearch::index($data);
        }    
        $params = [
            'index' => 'good',
            'type' => 'goods',
            'body' => [
                'query' => [
                    'match' => [
                        'name' => '测试'
                    ]
                ]
            ]
        ];
    
      

       
        // return $results = Elasticsearch::search($params);
        // $delete = ['index' => 'my_index'];
        // Elasticsearch::indices()->delete($delete);
        return $results = Elasticsearch::search($params);
        // $client = ClientBuilder::create()->build();
        // $return = $client->index($data);
        
    }


    public function arr()
    {
        $arr = [[1,4,7],[2,5,6],[1,6,5]];
        $data = [];
        foreach($arr as $k => $v)
        {   
            foreach($v as $k1 => $v1)
            {
                 $data[$k1][] = $v1;  
            } 
        }
        dd($arr,$data);
    }
    

    public function count()
    {
        Chart::Member();
    }

    public function Chart_normal()
    {
        $data = Chart::normal();
        dd($data);
    }

    public function Chart_Month_order()
    {
        $data = Chart::Month_order();
        dd($data);
    }

    public function Chart_Order_top10()
    {
        $data = Chart::Order_top10();
        dd($data);
    }

    public function Duanxin()
    {
        Duanxin::index();
    }

    public function Alert()
    {
        // Alert::message('Robots are working!')->persistent('Close');  
        // Alert::message('Message', 'Optional Title');
        // Alert::basic('Basic Message', 'Mandatory Title');
        // Alert::info('Info Message', 'Optional Title');
        Alert::success('Optional Title')->persistent("Close");
        // Alert::error('Error Message', 'Optional Title');
        // Alert::warning('警告提示', 'Optional Title');
        // return Redirect::home();
        return Redirect::home();
    }
}
