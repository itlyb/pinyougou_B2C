<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SeckillGood;
use App\Models\Good;

use Alert;

class SeckillController extends Controller
{
    public function seckgood()
    {   
        $date = date('Y-m-d H:i:s');
        $seckgood = SeckillGood::where('type',1)
        ->where('start_time','<',$date)
        ->where('end_time','>',$date)
        ->get();

        $seckgood_id = [];
        foreach($seckgood as $k => $v)
        {
            $seckgood_id[] = $v['good_id'];
        }

        $good = Good::whereIn('id',$seckgood_id)->get();

        return view('home.good.seckill',[
            'sec_good' => $seckgood,
            'good' => $good,
        ]);
    }
    
    public function seckill(Request $req)
    {
        $seck_id = $req->seck_id;
        $date = date('Y-m-d H:i:s');
        $seck_good = SeckillGood::where('id',$seck_id)->first();
        if(!$seck_good)
        {   
            Alert::warning('对不起，您搜索的商品不存在！');
            return back();
        }
        else if($seck_good['end_time'] < $date)
        {
            Alert::warning('对不起，已经过了秒杀时间！');
            return back();
        }
        $good = Good::where('id',$seck_good['good_id'])->first();

        return view('home.good.seckitem',['seck_good'=>$seck_good,'good'=>$good]);

    }
}
