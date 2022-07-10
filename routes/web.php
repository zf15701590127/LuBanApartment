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

 // 后台路由
 Route::prefix('back')->group(function(){
    // 用户管理
    Route::namespace('Back\Users')->name('back.users.')->group(function() {
        Route::resource('users', 'UsersController', ['only' => ['index', 'store', 'destroy', 'create', 'edit', 'update']]);
    });

    // 配置管理
    Route::namespace('Back\Configs')->name('back.configs.')->group(function() {
        // 项目配置
        Route::resource('projects', 'ProjectsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 话题分类配置
        Route::resource('topicCategories', 'TopicCategoriesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 楼栋管理
        Route::resource('buildings', 'BuildingsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 房间用途管理
        Route::resource('purposes', 'PurposesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 房源配置
        Route::resource('rooms', 'RoomsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 门店定价
        Route::resource('prices', 'PricesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 会计科目
        Route::resource('accountingSubjects', 'AccountingSubjectsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 租赁类型
        Route::resource('leaseTypes', 'leaseTypesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 签约类型
        Route::resource('signContractTypes', 'SignContractTypesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 合同类型
        Route::resource('contractTypes', 'ContractTypesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 证件类型配置
        Route::resource('certificateTypes', 'CertificateTypesController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 押金月数配置
        Route::resource('depositMonths', 'DepositMonthsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 租赁周期配置
        Route::resource('leaseTerms', 'leaseTermsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 销售渠道配置
        Route::resource('marketingChannels', 'MarketingChannelsController', ['only' => ['index', 'store', 'create', 'edit', 'update', 'destroy']]);
        // 支付方式配置
        Route::resource('paymentTypes', 'PaymentTypesController', ['only' => ['index', 'store', 'store', 'create', 'edit', 'update', 'destroy']]);
    });
 });

 // 前台路由
 Route::prefix('fore')->group(function() {
     // 用户身份验证相关路由
    Route::namespace('Fore\Sessions')->name('fore.sessions.')->group(function() {
        Route::get('login', 'SessionsController@create')->name('sessions.create');
        Route::post('login', 'SessionsController@store')->name('sessions.store');
        Route::delete('logout', 'SessionsController@destroy')->name('sessions.destroy');
    });

    // 前台用户相关
    Route::namespace('Fore\Users')->name('fore.users.')->group(function() {
        Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);
    });

    // 密码修改相关
    Route::namespace('Fore\Passwords')->name('fore.passwords.')->group(function() {
        Route::resource('passwords', 'PasswordsController', ['only' => ['edit', 'update']]);
    });

    // 话题相关
    Route::namespace('Fore\Topics')->name('fore.topics.')->group(function() {
        Route::resource('topics', 'TopicsController', ['only' => ['create', 'index', 'show', 'update', 'edit', 'store', 'destroy']]);
        Route::resource('topicCategories', 'TopicCategoriesController', ['only' => ['show']]);

        // 话题页面图片上传
        Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
    });

    // 房态相关
    Route::namespace('Fore\Rooms')->name('fore.rooms.')->group(function() {
        // 房态图
        Route::resource('rooms', 'RoomsController', ['only' => ['index']]);
        // 修改房间状态为脏房
        Route::post('rooms/{room}/dirtyStatusMark', 'RoomsController@dirtyStatusMark')->name('rooms.dirtyStatusMark');
        // 修改房间状态为维修房
        Route::post('rooms/{room}/repair', 'RoomsController@repairStatusMark')->name('rooms.repairStatusMark');
        // 修改脏房为可出租状态（0）
        Route::post('rooms/{room}/clean', 'RoomsController@cleanStatusMark')->name('rooms.cleanStatusMark');
        // 修改维修房为可出租状态（0）
        Route::post('rooms/{room}/repaired', 'RoomsController@repairedStatusMark')->name('rooms.repairedStatusMark');
    });

    // 租约详情
    Route::namespace('Fore\Contracts')->name('fore.contracts.')->group(function() {
        // 租约详情
        Route::resource('leases', 'LeasesController', ['only' => ['show']]);

        // 账单详情
        Route::resource('orders', 'OrdersController', ['only' => ['show']]);

        // 合同详情
        Route::resource('contracts', 'ContractsController', ['only' => ['show', 'create', 'store', 'index']]);
        // 预定转签约
        Route::post('contracts/reserveTransformContract', 'ContractsController@reserveTransFormContract')->name('contracts.reserveTransFormContract');

        // 居住人详情
        Route::resource('contractCustomers', 'ContractCustomersController', ['only' => ['show', 'create', 'store', 'edit', 'update', 'destroy']]);

        // 水电费详情
        Route::resource('utilities', 'UtilitiesController', ['only' => ['show']]);
    });

    // 预定
    Route::namespace('Fore\Reserves')->name('fore.reserves.')->group(function() {
        // 预定
        Route::resource('reserves', 'ReservesController', ['only' => ['create', 'store', 'index']]);

        // 预定取消
        Route::post('reserves/{reserve}/cancel', 'ReservesController@cancel')->name('reserves.cancel');

    });

    // PC 端支付（管家端操作支付）
    Route::namespace('Fore\Payments')->name('fore.payments.')->group(function() {
        // 订单支付
        Route::post('payments/{order}/order', 'PaymentsController@order')->name('payments.order');

        // 预定支付
        Route::post('payments/{reserve}/reserve', 'PaymentsController@reserve')->name('payments.reserve');
    });

    // 报表
    Route::namespace('Fore\Reports')->name('fore.reports.')->group(function() {
        // 交易流水报表
        Route::resource('bills', 'BillsController', ['only' => ['index']]);

        // 流水明细报表
        Route::resource('payments', 'PaymentsController', ['only' => ['index']]);
    });
});




// Route::get('/', 'TopicsController@index')->name('root');

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
