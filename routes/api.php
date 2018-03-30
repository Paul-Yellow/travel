<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => ['cors','api', 'jwt.check']
],function($router){
    $router->post('/auth/login', 'AuthController@login');
    $router->post('/auth/refresh', 'AuthController@refreshToken');
    $router->post('/auth/register','AuthController@register');
    $router->get('/auth/logout', 'AuthController@revokeToken');
    $router->get('/index','IndexController@index');
    $router->get('/newevent','NewEventsController@index');
    $router->get('/newevent/detail/{id}','NewEventsController@show');
    $router->get('/activeevent','ActiveEventsController@index');
    $router->get('/activeevent/detail/{id}','ActiveEventsController@show');
    $router->get('/offers','OffersController@index');
    $router->get('/offers/detail/{id}','OffersController@show');
    $router->get('/talent','TalentController@index');
    $router->get('/talent/detail/{id}','TalentController@show');
    $router->get('/mustv','LinkController@showAll');
    $router->post('/feedback', 'MeController@addFeedBack');
    $router->get('/category','AttractionController@showCategory');
    $router->get('/attraction/list','AttractionController@showList');
    $router->get('/attraction/detail/{id}','AttractionController@show');
    // 热门tag
    $router->get('/tagsAll','TagController@tagAll');
    $router->get('/tags','TagController@show');
    $router->get('/travel','AttractionController@findCategory');
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['jwt.auth','permission'],
    ],function($router){
        
        $router->resource('me', 'MeController',['except' => ['create','show','edit','destroy']]);
        $router->resource('dashborde','DashController',['except'=>['create','show','update']]);
        $router->resource('uploadimg','UploadImgController',['except'=>['create','update','edit']]);
        $router->resource('users','UserController');
        // 改变用户状态
        $router->put('updatestatus/{id}','UserController@updateStatus')->name('users.updatestatus');
        // 权限管理
        $router->resource('permission','PermissionController',['except'=>['create','show']]);
        $router->resource('role','RoleController');
    });
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['jwt.auth']
    ],function($router){
        $router->resource('newevents','NewEventsController');
        $router->resource('activeevents','ActiveEventsController');
        $router->resource('offers','OffersController');
        $router->resource('attraction','AttractionController');
        $router->resource('category','CategoryController');
        $router->resource('tag','TagController',['except'=>['create']]);
        $router->resource('link','LinkController',['except'=>['create']]);
        $router->resource('talent','TalentController',['except'=>['create']]);
        // 读取站内信息
        $router->get('me/notifications', 'MeController@getNotifications');
        $router->post('me/notifications/read', 'MeController@markAsRead');
        $router->post('me/notifications/read/{id?}', 'MeController@markAsRead');
        // 获取系统配置信息
        $router->get('systeminfo','SystemController@getSystemInfo');
        // 获取系统操作日志
        $router->get('log','MeController@getLogList');
        // 反馈路由
        $router->resource('feed','FeedbackController');
        // 收藏
        $router->post('/newevents/favourite','NewEventsController@postFavouritePost');
        $router->post('/activeevents/favourite','ActiveEventsController@postFavouritePost');
        $router->post('/offers/favourite','OffersController@postFavouritePost');
        $router->post('/talent/favourite','TalentController@postFavouritePost');
        // 点赞
        $router->post('/newevents/links','NewEventsController@postLikePost');
        $router->post('/activeevents/links','ActiveEventsController@postLikePost');
        $router->post('/offers/links','OffersController@postLikePost');
        $router->post('/talent/links','TalentController@postLikePost');
        // 评论
        $router->post('/newevents/{id}/comment','NewEventsController@storeComment');
        $router->post('/activeevents/{id}/comment','ActiveEventsController@storeComment');
        $router->post('/offers/{id}/comment','OffersController@storeComment');
        $router->post('/talent/{id}/comment','TalentController@storeComment');
        // 关注
        $router->post('/me/followers','MeController@postFollowers');
        // 评论顶踩
        $router->post('/me/voters/comment/{type}', 'MeController@postVoteComment')->where('type', 'up|down');
        // 评论列表
        $router->get('/comment','MeController@commentList');
        // 删除评论
        $router->post('/comment/{id}','MeController@deleteComment');
    });
});

