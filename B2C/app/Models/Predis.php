<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predis extends Model
{
    private static $redis = null;
    // 私有的克隆，防止克隆
    private function __clone(){}
    // 私有的构造，防止在类外部 new 对象
    private function __construct(){}

    // 唯一对外公共的方法，用来获取唯一的 redis 对象
    public static function getInstance()
    {
        // 从配置文件中读取账号
        $config = [
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ];

        // 如果还没有 redis 就生成一个
        // 只有每 一次 才会连接
        if(self::$redis === null)
        {
            // 放到队列中
            self::$redis = new \Predis\Client($config);
        }
        // 直接返已有的redis 对象
        return self::$redis;
    }

    // 
}
