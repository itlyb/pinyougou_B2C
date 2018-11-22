<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodImg extends Model
{   
    public $timestamps = false;
    protected $fillable = ['img','good_id'];

    public function goods()
    {
        return $this->belongsTo(Good::class, 'good_id');
    }
}
