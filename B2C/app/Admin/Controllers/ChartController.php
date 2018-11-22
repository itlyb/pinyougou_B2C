<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;

use App\Models\Chart;

class ChartController extends Controller
{   
    // 网站 总交易信息 报表
    public function index(Content $content)
    {   
        // 获取数据
        $member = Chart::Member();// 获取会员种类数量
        $normal = Chart::normal();// 获取网站基本信息


        // 制作图表
        $box1 = self::box("会员构成一览表","admin.chart.chart1",['member'=>$member]);
        $box2 = self::box('网站基本数据','admin.chart.normal',['data'=>$normal]);
        

        // 页面显示
        return $content->header('chart')
        ->description('.....')
        ->body("$box2
                <div style='padding:10px;width:350px;height:200px;float:left;'>$box1</div>");
    }


    // 网站 月交易信息 报表
    public function second(Content $content)
    {   
        // 获取数据
        $data1 = Chart::Month_order();
        $data2 = Chart::Order_top10();

        // dd($data1,$data2);
        // 制作盒子
        $box1 = self::box('网站月交易信息','admin.chart.normal',['data'=>$data1]);
        $box2 = self::box('月销售量前十','admin.chart.chart',['data'=>$data2]);

        // 页面显示
        return $content->header('chart')
        ->description('.....')
        ->body("$box1")
        ->body("<div style='padding:10px;width:400px;height:100px;float:left;'>$box2</div>");
    }

    // 制作盒子
    public static function box($title,$view,$data=[],$style='info')
    {
        $box = new Box($title, view($view,$data));
        $box->collapsable();
        $box->style($style);
        $box->solid(); 
        return $box;
    }
}
