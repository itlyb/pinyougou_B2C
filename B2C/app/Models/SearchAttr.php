<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 全文索引
use Laravel\Scout\Searchable;

class SearchAttr extends Model
{
    
    use Searchable;

    /**
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id', 'name', 'type_name','tags');
    }

    
    public function specs()
    {
        return $this->hasMany(SearchSpec::class, 'attr_id');
    }
}
