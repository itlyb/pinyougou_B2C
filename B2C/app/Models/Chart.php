<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Chart extends Model
{   
    // 返回会员种类数量
    public static function Member()
    {   
        $data = [];
        $data['pt'] = User::where('level',0)->count();   
        $data['by'] = User::where('level',1)->count();
        $data['hj'] = User::where('level',2)->count();
        $data['zj'] = User::where('level',3)->count();
        $data['zs'] = User::where('level',4)->count();
        $data['zz'] = User::where('level',5)->count();
        return $data;
    }

    // 获取网站基本信息
    public static function normal()
    {
        $data = [];
        $data['All_money'] = UserOrder::where('state',4)->sum('money');
        $data['All_order'] = UserOrder::count();
        $data['All_succe'] = UserOrder::where('state',4)->count();
        $data['All_error'] = UserOrder::where('state',3)->count();
        $data['All_ermon'] = UserOrder::where('state',3)->sum('money');
        return $data;
    }

    // 月购买交易记录
    public static function Month_order()
    {   
        $data = [];
        $data['All_order'] = UserOrder::where('created_at','>=',date("Y-m"))->count();
        $data['All_succe'] = UserOrder::where('created_at','>=',date("Y-m"))->where('state',4)->count();
        $data['All_error'] = UserOrder::where('created_at','>=',date("Y-m"))->where('state',3)->count();
        $data['All_money'] = UserOrder::where('created_at','>=',date("Y-m"))->where('state',4)->sum('money');
        $data['All_ermon'] = UserOrder::where('created_at','>=',date("Y-m"))->where('state',3)->sum('money');
        return $data;
    }

    // 当月销售量前十
    public static function Order_top10()
    {   
        $data = []; 
        $sql = "select sum(good_num) num,good_id name from good_user_orders where created_at >= ? and state = 4 group by name order by num desc limit 10;";
        $data = DB::select($sql,[date('Y-m')]);
        foreach($data as $v)
        {
            $v->name = Good::where('id',$v->name)->first()['name'];
        }
        return $data;
    }

    
}
