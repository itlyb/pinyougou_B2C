<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Image;

use Illuminate\Http\Request;

class Images extends Model
{
    public function Images()
    {
        $img = $req->img;
        $this->Resize($img);
        return back();
    }




    // 产生缩略图
    public static function Resize($img,$data=['150','350','650'])
    {   
        $date = date('Ymd');
        // 缩略 -----------------------------
        $path = Path.'public/uploads/'.$img; 
        $img1 = Image::make($path);

        $img1->resize($data[0], $data[0]);
        $small = str_replace("/$date/","/$date/small",$path);
        $img1->save($small);

        $img1->resize($data[1], $data[1]);
        $middle = str_replace("/$date/","/$date/middle",$path);
        $img1->save($middle);

        $img1->resize($data[2], $data[2]);
        $large = str_replace("/$date/","/$date/large",$path);
        $img1->save($large);
        // 缩略 -----------------------------
    }
}
