<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodSpec extends Model
{   
    protected $fillable = ['attr_id','name'];
    public $timestamps = false;

    public function attrs()
    {
        return $this->belongsTo(GoodAttr::class, 'attr_id');
    }

    public function goods()
    {
        return $this->belongsTo(Good::class, 'good_id');
    }
}
