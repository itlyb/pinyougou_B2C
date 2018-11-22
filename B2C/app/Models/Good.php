<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 全文索引
use Laravel\Scout\Searchable;


class Good extends Model
{   

    use Searchable;
    public $asYouType = true;
    /**
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id', 'name', 'little_name','description','spec');
    }

    public function attrs()
    {
        return $this->hasMany(GoodAttr::class, 'good_id');
    }

    public function values()
    {
        return $this->hasMany(GoodSpec::class, 'good_id');
    }

    public function imgs()
    {
        return $this->hasMany(GoodImg::class, 'good_id');
    }

}
