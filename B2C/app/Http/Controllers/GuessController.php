<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserFeet;
use App\Models\Good;
use App\Models\RecommendGood;
use App\Models\RecommendType;

class GuessController extends Controller
{
    public static function guess_you_like()
    {
        // 获取猜你喜欢商品
        if(session('users_id')){

            $date = date('Y-m-d',strtotime(date('Y-m-d', time()-86400)));
            $foot = UserFeet::where('created_at','>=',$date)->where('user_id',session('users_id'))->get();
            $str = "";
            foreach($foot as $k=>$v)
            {
                $str .= Good::where('id',$v['good_id'])->first()['tags'];
            }
            return Good::search($str)->take(7)->get();

        }else{

            $good = RecommendGood::where('type_id',1)->orderBy('created_at','desc')->take(7)->get();
            $like_good = [];
            foreach($good as $v)
            {
                $like_good[] = Good::where('id',$v['good_id'])->first();
            }
            return $like_good;
        } 
    }

    public static function hot_good()
    {
        $hot_good_id = RecommendGood::select('good_id')->where('type_id',4)->orderBy('created_at','desc')->take(4)->get();
        $hot_good = Good::whereIn('id',$hot_good_id)->get();
        return  $hot_good;
    }

    public static function recommend($num)
    {
        $good_id = RecommendGood::select('good_id')->where('type_id',$num)->orderBy('created_at','desc')->take(4)->get();
        $good = Good::whereIn('id',$good_id)->get();
        return  $good;
    }
}
