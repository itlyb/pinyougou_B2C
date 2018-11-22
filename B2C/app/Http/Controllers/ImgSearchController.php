<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImgSearchController extends Controller
{      

    public static function get_access_token()
    {
        $url = 'https://aip.baidubce.com/oauth/2.0/token';
        $post_data['grant_type']       = 'client_credentials';
        $post_data['client_id']      = 'irslFhU7jVbIptG55jXaVDAI';
        $post_data['client_secret'] = 'pTPxx6U60HyWaA4RBZgC8vtBGryO2e53';
        $o = "";
        foreach ( $post_data as $k => $v ) 
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);
        
        $res = self::request_post($url, $post_data);

        return $res;
    }

    /**
 * 发起http post请求(REST API), 并获取REST请求的结果
 * @param string $url
 * @param string $param
 * @return - http response body if succeeds, else false.
 */
public  static function request_post($url = '', $param = '')
{
    if (empty($url) || empty($param)) {
        return false;
    }

    $postUrl = $url;
    $curlPost = $param;
    // 初始化curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $postUrl);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    // 要求结果为字符串且输出到屏幕上
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // post提交方式
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    // 运行curl
    $data = curl_exec($curl);
    curl_close($curl);

    $res = json_decode($data);
    // dd($res->access_token);
    return $res;
}

    public static function ImgSearch($path)
    {
        $token = self::get_access_token()->access_token;
        $url = 'https://aip.baidubce.com/rest/2.0/image-classify/v2/advanced_general?access_token=' . $token;
        $img = file_get_contents($path);
        $img = base64_encode($img);
        $bodys = array(
            'image' => $img,
            'with_face' => 1
        );
        $res = self::request_post2($url, $bodys);

        return $res;
    }

    public static function request_post2($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        } 
        
        $postUrl = $url;
        $curlPost = $param;
        $curl = curl_init();//初始化curl
        curl_setopt($curl, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($curl, CURLOPT_HEADER, 0);//设置header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($curl);//运行curl
        curl_close($curl);
        
        return $data;
    }

	
}
