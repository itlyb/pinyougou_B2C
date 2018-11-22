<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 全文索引
use Laravel\Scout\Searchable;

class GoodBrand extends Model
{   
    use Searchable;
    /**
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id', 'name', 'tags');
    }

    public $timestamps = false;
}
