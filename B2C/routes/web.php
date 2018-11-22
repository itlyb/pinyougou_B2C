<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// 测试
Route::get('/test','TestController@add_types');


Route::get('/qrcode','QrcodeController@qrcode')->name('qrcode');
Route::get('/wxpay','WxpayController@pay')->name('wxpay');
Route::get('/testview','TestController@code')->name('testview');
Route::get('/fenli',function(){
    return view('fenli');
});
Route::get('/fen','TestController@fenli')->name('fenli');



// 网站主页------------------------------------------------------------------
Route::get('/','IndexController@index')->name('home');



// 用户----------------------------------------------------------------------
// 登录
Route::get('/login_before','LoginController@login_before')->name('login_before');
Route::post('/do_login','LoginController@do_login')->name('do_login');
// 注册
Route::get('/register_before','RegisterController@register_before')->name('register_before');
Route::post('/do_register','RegisterController@do_register')->name('do_register');
Route::get('/duanxin','RegisterController@duanxin')->name('duanxin');
// 退出登录
Route::get('/logout','LoginController@logout')->name('logout');




// 商品----------------------------------------------------------------------
// 商品单品页
Route::middleware(['writefoot'])->group(function(){
    Route::get('/item','GoodController@item')->name('item');
});
Route::post('/spus','GoodController@spus')->name('spus');
// 商品搜索页
Route::post('/search','SearchController@search')->name('search');
Route::get('/search_view','SearchController@search_view')->name('search_view');
// 商品推荐文章阅读
Route::get('/article','GoodController@article')->name('article');
// 秒杀商品
Route::get('/seckgood','SeckillController@seckgood')->name('seckgood');
Route::get('/seckill','SeckillController@seckill')->name('seckill');

// 检查是否登录中间件---------------------------------------------------------
Route::middleware(['checklogin'])->group(function(){
 
    // 购物车-----------------------
    // 加入购物车
    Route::post('/good_car','GoodController@good_car')->name('good_car');
    // 购物车跳转显示
    Route::get('/good_cart','GoodController@good_cart')->name('good_cart');
    // 购物车 ajax 商品数量修改
    Route::get('/good_cart_ajax','GoodController@good_cart_ajax')->name('good_cart_ajax');
    // 购物车 商品删除
    Route::post('/good_cart_delete','GoodController@good_cart_delete')->name('good_cart_delete');
    // 购物车 商品搜索
    Route::post('/good_cart_search','GoodController@good_cart_search')->name('good_cart_search');
    // 付款
    Route::post('/get_order_info','GoodController@get_order_info')->name('get_order_info');
    Route::get('/get_order_info','GoodController@get_order_info2')->name('get_order_info2');
    Route::post('/pay','GoodController@pay')->name('pay');
    Route::get('/pay_view','GoodController@pay_view')->name('pay_view');
    // 检查订单信息
    Route::get('/orderStatus_ajax','GoodController@orderStatus')->name('orderStatus');

    // 个人信息中心--------------------------------------------------------------------------------------
    // 订单信息主页
    Route::get('/home_index','UserController@home_index')->name('home_index');
    // 待发货
    Route::get('/home_unshipp','UserController@home_unshipp')->name('home_unshipp');
    // 已发货
    Route::get('/home_shipp','UserController@home_shipp')->name('home_shipp');
    // 待评价
    Route::get('/home_complete','UserController@home_complete')->name('home_complete');
    // 退款中
    Route::get('/home_refuning','UserController@home_refuning')->name('home_refuning');
    // 已退款
    Route::get('/home_refund','UserController@home_refund')->name('home_refund');
    
    // 我的足迹
    Route::get('/home_foot','UserController@home_foot')->name('home_foot');
    // 我的收藏
    Route::post('home_do_collect','UserController@home_do_collect')->name('home_do_collect');
    Route::get('/home_collect','UserController@home_collect')->name('home_collect');
    Route::post('/home_collect_delete','UserController@home_collect_delete')->name('home_collect_delete');
    // 商品评价
    Route::post('/home_order_comment','UserController@home_order_comment')->name('home_order_comment');

    // 个人信息设置------------------------------------------------------------------------------------------
    // 基本信息
    Route::get('/home_info','UserController@home_info')->name('home_info');
    Route::post('/home_info_base','UserController@home_info_base')->name('home_info_base');
    Route::post('/home_info_img','UserController@home_info_img')->name('home_info_img');
    // 收货地址
    Route::get('/home_address','UserController@home_address')->name('home_address');
    Route::post('/home_address_set','UserController@home_address_set')->name('home_address_set');
    Route::post('/home_address_use','UserController@home_address_use')->name('home_address_use');
    Route::post('/home_address_delete','UserController@home_address_delete')->name('home_address_delete');
    Route::post('/home_address_edit','UserController@home_address_edit')->name('home_address_edit');
    // 安全管理
    Route::get('/home_safe','UserController@home_safe')->name('home_safe');
    Route::post('/home_safe_password','UserController@home_safe_password')->name('home_safe_password');
    Route::post('/home_safe_first','UserController@home_safe_first')->name('home_safe_first');
    Route::get('/home_safe_second','UserController@home_safe_second')->name('home_safe_second');
    Route::post('/home_safe_second_sub','UserController@home_safe_second_sub')->name('home_safe_second_sub');
    Route::get('/home_safe_third','UserController@home_safe_third')->name('home_safe_third');

});
Route::post('/notify','WxpayController@notify')->name('notify');