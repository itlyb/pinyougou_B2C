<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/chart', 'ChartController@index');// 图表
    $router->get('/chart1', 'ChartController@second');// 图表

    // 用户管理
    $router->resource('users', UserController::class);
    // 商品管理
    $router->resource('goods', GoodController::class);
    // 订单管理
    $router->resource('orders', UserOrderController::class);
    // 商品类型管理
    $router->resource('good_types', TypeController::class);
    // 品牌管理
    $router->resource('brands', BrandController::class);
    // 属性管理
    $router->resource('attr', AttrController::class);
    // 单管理
    $router->resource('spus', SpuController::class);
    // 会员管理
    $router->resource('member', MemberController::class);
    // 秒杀类型管理
    $router->resource('seckType', seckTypeController::class);
    // 秒杀商品管理
    $router->resource('seckGood', seckGoodController::class);
    // 用户登录日志管理
    $router->resource('loginLog', LoginLogController::class);
    // 商品图片管理
    $router->resource('goodImg', GoodImgController::class);
    // 广告管理
    $router->resource('advert', AdvertController::class);
    // 广告种类管理
    $router->resource('advertType', AdvertTypeController::class);
    // 网站文章管理
    $router->resource('article', ArticleController::class);
    // 网站文章类型管理
    $router->resource('articleType', ArticleTypeController::class);
    // 用户购买日志管理
    $router->resource('buyLog', BuyLogController::class);  
    // 搜索管理
    $router->resource('searchAttr', SearchAttrController::class);
    $router->resource('searchSpec', SearchSpecController::class);
    // 推荐商品
    $router->resource('recommend', RecommendController::class);
    $router->resource('recommendType', RecommendTypeController::class);
});
