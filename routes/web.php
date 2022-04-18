<?php

use Illuminate\Support\Facades\Route;

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

/*
force：代表前台。
back：代表后台。
client: 代表客户端。
 */

Route::get('/', 'TopicsController@index')->name('root');

// 用户身份验证相关路由
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

// 个人页面
Route::resource('users', 'UsersController', ['only' => ['show', 'index', 'store', 'destroy', 'create']]);

// 前台用户更新
Route::patch('foreUsers/{user}', 'UsersController@foreUsersUpdate')->name('users.foreUsersUpdate');
Route::get('foreUsers/{user}/edit', 'UsersController@foreUsersEdit')->name('users.foreUsersEdit');

// 后台用户更新
Route::patch('backUsers/{user}', 'UsersController@backUsersUpdate')->name('users.backUsersUpdate');

// 修改密码
Route::resource('passwords', 'PasswordsController', ['only' => ['edit', 'update']]);

// 话题页面
Route::resource('topics', 'TopicsController', ['only' => ['create', 'index', 'show', 'update', 'edit', 'store', 'destroy']]);

// 话题分类
Route::resource('topicCategories', 'TopicCategoriesController', ['only' => ['show']]);

// 话题页面图片上传
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 房态图
Route::resource('roomManagements', 'RoomManagementsController', ['only' => ['index']]);

// 租约详情
Route::resource('leaseDetails', 'LeaseDetailsController', ['only' => ['show']]);

// 账单详情
Route::resource('accountDetails', 'AccountDetailsController', ['only' => ['show']]);

// 合同详情
Route::resource('contractDetails', 'ContractDetailsController', ['only' => ['show']]);

// 居住人详情
Route::resource('residentDetails', 'ResidentDetailsController', ['only' => ['show']]);

// 水电费详情
Route::resource('utilityDetails', 'UtilityDetailsController', ['only' => ['show']]);

// test
Route::get('test', function () {
    // 房间签订的合同月租金
    $rent_amount = 2830.00;

    // 将每个账期的开始和结束时间放到数组中
    $orders = [
        ['begin_date' => '2021-06-24',	'end_date' => '2021-07-23'],
        ['begin_date' => '2021-07-24',	'end_date' => '2021-08-23'],
        ['begin_date' => '2021-08-24',	'end_date' => '2021-09-23'],
        ['begin_date' => '2021-09-24',	'end_date' => '2021-10-23'],
        ['begin_date' => '2021-10-24',	'end_date' => '2021-11-23'],
        ['begin_date' => '2021-11-24',	'end_date' => '2021-12-23'],
        ['begin_date' => '2021-12-24',	'end_date' => '2022-01-23']
    ];


    echo '<table>';

    // 循环遍历数组中的每一天计算出每一天的房间价格
    foreach ($orders as $order) {

        // 获取账期开始日期
        $begin_date  = $order['begin_date'];

        // 获取账期结束日期
        $end_date = $order['end_date'];

        // 计算整个账期内一共多少天
        $bcsub_day = (strtotime($end_date) - strtotime($begin_date)) / 86400;

        // 循环打印账期内没一天的租金
        for ($i = 0; $i <= $bcsub_day; $i ++) {
            // 获取当前遍历的日期
            $today = date('Y-m-d', strtotime("$begin_date + $i day"));

            // 判断是否是账期的最后一天
            if ($today == $end_date) {
                $rent_day_amount = $rent_amount - round($rent_amount / ($bcsub_day + 1), 2) * ($bcsub_day);
            } else {
                $rent_day_amount = round($rent_amount / ($bcsub_day + 1), 2);
            }

            echo "<tr><td>$today</td><td>$rent_day_amount</td></tr>";
        }
    }

    echo '</table>';
});
