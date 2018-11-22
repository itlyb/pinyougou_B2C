<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    public function makeLog($ip,$browser,$device)
    {   
        Loginlog::insert([
            'user_id' => session('users_id'),
            'ip' => $ip,
            'browser' => $browser,
            'device' => $device,
        ]);

    }
}
