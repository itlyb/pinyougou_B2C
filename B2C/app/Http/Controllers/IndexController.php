<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GoodType;
use App\Models\Good;
use App\Models\GoodBrand;
use App\Models\Article;
use App\Models\UserFeet;

class IndexController extends Controller
{
    public function index()
    {   
        // 获取分类信息
        if(!cache('type')){
            $type = GoodType::where('pid',0)->get();
            cache(['type' => $type], 60);
            $type1 = [];
            foreach($type as $k => $v)
            {
                $type1[$k] = GoodType::where('pid',$v['id'])->get(); 
            }
            cache(['type1' => $type1], 60);
            $type2 = [];
            foreach($type1 as $k => $v)
            {
                foreach($v as $k1 => $v2)
                {
                    $type2[$k][$k1] = GoodType::where('pid',$v2['id'])->get();
                }
            }
            cache(['type2' => $type2], 60);
        }
        else
        {
            $type = cache('type');
            $type1 = cache('type1');
            $type2 = cache('type2');
        }
        // 获取轮播图文章
        if(!cache('articles'))
        {
            $articles = Article::orderBy('created_at','desc')->where('type',5)->take(3)->get();
            cache(['articles'=>$articles],60);
        }
        else
        {
            $articles = cache('articles');
        }
        
        // 今日推荐文章
        if(!cache('articles_today'))
        {
            $articles_today = Article::orderBy('created_at','desc')->where('type',4)->take(4)->get();
            cache(['articles_today'=>$articles_today],60);
        }
        else
        {
            $articles_today = cache('articles_today');
        }
        
        // 猜你喜欢
        if(!cache('like_good'))
        {
            $like_good = GuessController::guess_you_like();
            cache(['like_good'=>$like_good],60);
        }
        else
        {
            $like_good = cache('like_good');
        }
        
        // 推荐品牌
        if(!cache('brand'))
        {
            $brand = GoodBrand::take(20)->get();
            cache(['brand'=>$brand],60);
        }
        else
        {
            $brand = cache('brand');
        }
        
        // 品优购快报
        if(!cache('quick_article'))
        {
            $quick_article = Article::orderBy('created_at','desc')->where('type',7)->take(8)->get();
            cache(['quick_article'=>$quick_article],60);    
        }
        else
        {
            $quick_article = cache('quick_article');
        }
        
        // 家用电器
        if(!cache('home_elc'))
        {
            $home_elc = GuessController::recommend(2);
            cache(['home_elc'=>$home_elc],60);
        }
        else
        {
            $home_elc = cache('home_elc');
        }
        
        // 手机通讯
        if(!cache('phone_mes'))
        {
            $phone_mes = GuessController::recommend(3);
            cache(['phone_mes'=>$phone_mes],60);
        }
        else
        {
            $phone_mes = cache('phone_mes');
        }
        
        // 快来看看
        if(!cache('look_good'))
        {   
            $look_good = GuessController::recommend(5);
            cache(['look_good'=>$look_good],60);
        }
        else
        {
            $look_good = cache('look_good');
        }
        


        return view('index',[
            'type'=>$type,'type1'=>$type1,'type2'=>$type2,
            'article'=>$articles,'article_today'=>$articles_today,
            'like_good'=>$like_good,'brand'=>$brand,
            'quick_article'=>$quick_article,
            'home_elc' => $home_elc,
            'phone_mes' => $phone_mes,
            'look_good' => $look_good,
        ]);
    }
}
