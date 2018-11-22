<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodAttr extends Model
{   
    protected $fillable = ['good_id','name'];
    public $timestamps = false;
    
    public function goods()
    {
        return $this->belongsTo(Good::class, 'good_id');
    }

    public function values()
    {
        return $this->hasMany(GoodSpec::class, 'attr_id');
    }
}
