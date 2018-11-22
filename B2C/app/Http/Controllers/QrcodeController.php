<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;

class QrcodeController extends Controller
{
    // 把一个字符串生成 二维码图片并显示
    public function qrcode(Request $req)
    {
        $str = $req->code;
        $qrCode = new QrCode($str);
        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }
}
