<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchSpec extends Model
{   
    protected $fillable = ['name'];
    
    public function attrs()
    {
        return $this->belongsTo(SearchAttr::class, 'attr_id');
    }
}
