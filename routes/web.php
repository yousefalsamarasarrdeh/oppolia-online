<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminUserManagement;
use App\Http\Controllers\Dashboard\DesignerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\JoinAsDesignerController;
use App\Http\Controllers\Dashboard\JoinAsDesignerController as DashboardJoinAsDesignerController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\OrderController;
use App\Http\Controllers\Designer\OrderDraftController;
use App\Http\Controllers\Dashboard\RegionController;
use App\Http\Controllers\Auth\OtpLoginController;
use App\Http\Controllers\Users\InstallmentController;
use App\Http\Controllers\Designer\SalesController;
use App\Http\Controllers\Dashboard\SaleController;
use App\Http\Controllers\Users\DesignerRatingController;

use App\Http\Controllers\Frontend\HomeController;



Route::middleware(['admin'])->group(function () {


    // إضافة طرق لـ DesignerController مع تحديد الأسماء


    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


//  product and its descriptions
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');




});


Route::prefix('dashboard')->middleware(['adminOrsales_manager'])->group(function () {
    Route::get('admin/regions', [RegionController::class, 'index'])->name('admin.regions');
});





Route::prefix('dashboard')->middleware('adminOrsales_managerOrarea_manager')->group(function () {


    Route::get('/orders/data', [DashboardOrderController::class, 'getOrders'])->name('orders.data');

    Route::get('orders', [DashboardOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/filter', [DashboardOrderController::class, 'filter'])->name('admin.orders.filter');
    Route::patch('orders/{order}/change-designer', [DashboardOrderController::class, 'changeDesigner'])->name('dashboard.orders.changeDesigner');

    Route::get('users_main', [AdminUserManagement::class, 'main_index'])->name('admin.users.index.main');
    Route::get('/users/{user}/edit', [AdminUserManagement::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserManagement::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserManagement::class, 'destroy'])->name('users.destroy');

    Route::get('/designers', [DesignerController::class, 'index'])->name('admin.designers.index');
    Route::delete('/designers/{designer}', [DesignerController::class, 'destroy'])->name('admin.designers.destroy');
    Route::get('designer/edit/{user}', [DesignerController::class, 'showEditForm'])->name('designer.showEditForm');
    Route::post('designer/update/{user}', [DesignerController::class, 'update'])->name('designer.storeOrUpdate');
    Route::get('designer/show/{user}', [DesignerController::class, 'showDesigner'])->name('designer.show');


    Route::get('/admin/join-as-designer/{joinasdesigner}/{notificationId}', [DashboardJoinAsDesignerController::class, 'showWithNotifaction'])->name('admin.joinasdesigner.showWhitNotficition');
    Route::get('/admin/join-as-designer', [DashboardJoinAsDesignerController::class, 'index'])->name('admin.joinasdesigner.index');
    Route::get('/admin/join-as-designer/{id}', [DashboardJoinAsDesignerController::class, 'show'])->name('admin.joinasdesigner.show');
    Route::delete('/admin/join-as-designer/{id}', [DashboardJoinAsDesignerController::class, 'destroy'])->name('admin.joinasdesigner.delete');



    Route::get('/admin/orders/{order}/{notificationId?}', [\App\Http\Controllers\Dashboard\OrderController::class, 'show'])->name('admin.order.show');
    Route::get('/admin/notifications', [\App\Http\Controllers\Dashboard\NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\Dashboard\NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/notifications/delete-all-read', [\App\Http\Controllers\Dashboard\NotificationController::class, 'deleteAllReadNotifications'])->name('notifications.deleteAllRead');


    Route::get('/sales', [SaleController::class, 'index'])->name('dashboard.sales.index');
    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('dashboard.sales.edit');
    Route::post('/sales/{sale}/update', [SaleController::class, 'update'])->name('sales.update');





});


Route::middleware(['auth' ,'set-locale'])->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.myOrders');
    Route::get('/order/{order}/{notificationId}', [OrderController::class, 'show'])->name('user.order.show');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    // قبول التصميم
    Route::post('/order/{order}/accept-draft/{draft}', [OrderController::class, 'acceptDraft'])->name('order.acceptDraft');

    Route::post('/order/{order}/redesign-draft/{draft}', [OrderController::class, 'redesignDraft'])->name('order.redesignDraft');
// تغيير المصمم
    Route::post('/order/{order}/change-designer', [OrderController::class, 'changeDesigner'])->name('order.changeDesigner');


    Route::get('user/notifications', [\App\Http\Controllers\Users\NotificationController::class, 'index'])->name('user.notifications.index');

    Route::post('/installment/update-status', [InstallmentController::class, 'updateStatus'])->name('installment.updateStatus');

    Route::post('/rate-designer', [DesignerRatingController::class, 'store'])
        ->name('rate.designer');
    Route::put('/rate-designer/{id}', [DesignerRatingController::class, 'update'])->name('update.designer.rating');
});



Route::middleware(['designer'])->group(function () {
    // معالجة الطلب - ثابت ويأتي أولاً
    Route::get('/designer/orders/{order}/processing', [\App\Http\Controllers\Designer\HomeController::class, 'processing'])->name('designer.order.processing');

// عرض الطلب باستخدام notificationId
    Route::get('/designer/orders/{order}/{notificationId}', [\App\Http\Controllers\Designer\HomeController::class, 'show'])->name('designer.order.show');

// المسارات الأخرى كما هي
    Route::patch('/designer/orders/{order}/accept', [\App\Http\Controllers\Designer\HomeController::class, 'accept'])->name('designer.orders.accept');
    Route::patch('/designer/orders/{order}/reject', [\App\Http\Controllers\Designer\HomeController::class, 'reject'])->name('designer.orders.reject');
    Route::get('/designer/approved-orders', [\App\Http\Controllers\Designer\HomeController::class, 'approvedOrders'])->name('designer.approved.orders');
    Route::get('/designer/orders/{order}', [\App\Http\Controllers\Designer\HomeController::class, 'showWithoutNotification'])->name('designer.order.show_without_notification');

// تحديث معالجة الطلب
    Route::post('/designer/orders/{order}/update_processing', [\App\Http\Controllers\Designer\DesignerMeetingCustomerController::class, 'UpdateMeeting'])->name('designer.order.update_processing');

    Route::get('/dashborad/designer',[\App\Http\Controllers\Designer\HomeController::class,'index'])->name('designer.notification');



// تخزين استبيان الطلب
    Route::post('/designer/orders/{order}/survey', [\App\Http\Controllers\Designer\SurveyQuestionController::class, 'store'])->name('designer.order.survey.store');


    Route::post('/designer/orders/{orderId}/order_draft', [OrderDraftController::class, 'store'])->name('designer.order_draft.store');

    Route::post('/designer/orders/{orderId}/order_draft_finalized', [OrderDraftController::class, 'store_finalized'])->name('designer.order_draft_finalized.store');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\Designer\NotificationController::class, 'destroy'])->name('delete.notification');
    Route::post('/notifications/delete-all-read', [\App\Http\Controllers\Designer\NotificationController::class, 'deleteAllReadNotifications'])->name('delete.allReadnotification');
    Route::post('/designer/sales/{sale}/installments', [SalesController::class, 'storeInstallment'])
        ->name('sales.installments.store');

    Route::post('/designer/sales/{sale}/installments/third', [SalesController::class, 'storeThirdInstallment'])
        ->name('sales.installments.storeThird');
    Route::get('/designer/sales/{sale}/complete', [SalesController::class, 'completeOrder'])
        ->name('sales.completeOrder');


});

Route::get('set/lang/{lang}',function ($lang){
    if(in_array($lang,['en','ar'])) {
        setcookie('lang',$lang,time()+(68*24*365),'/');
    }
    return redirect()->back();
}) ;




Route::middleware(['set-locale'])->group(function () {



    Route::get('/', [HomeController::class, 'index'])->name('welcome');
    Route::get('/about', [HomeController::class, 'about'])->name('home.about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

});
Route::middleware('guest')->group(function () {
 //   Route::get('/login-phone', [OtpLoginController::class, 'showPhoneForm'])->name('login.phone');
    Route::post('/login-phone', [OtpLoginController::class, 'sendOtp'])->name('otp.send');
    Route::get('/verify-otp', [OtpLoginController::class, 'showOtpForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpLoginController::class, 'verifyOtp'])->name('otp.verify');

    // إضافة مسار تسجيل الدخول يدويًا
    Route::get('/login', [OtpLoginController::class, 'showPhoneForm'])->name('login');
    Route::post('/login', [OtpLoginController::class, 'sendOtp'])->name('login');
});

// مسار تسجيل الخروج
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// مسار الصفحة الرئيسية
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/joinasdesigner', [JoinAsDesignerController::class, 'create'])->name('joinasdesigner.create');
Route::post('/joinasdesigner', [JoinAsDesignerController::class, 'store'])->name('joinasdesigner.store');
//Auth::routes();


//Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index1'])->name('home');
//Route::get('/testotp', [App\Http\Controllers\HomeController::class, 'testotp']);

//Route::get('/verify-otp/{phone}', [RegisterController::class, 'showOtpVerifyPage'])->name('otp.verify.page');
//Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('otp.verify');





// عرض صفحة إدخال رمز OTP باستخدام GET
//Route::get('otp/verify', [LoginController::class, 'showVerifyForm'])->name('otp.verify.log-page');

// التحقق من رمز OTP المدخل باستخدام POST
//Route::post('otp/verify', [LoginController::class, 'verifyOTP'])->name('otp.verify.log');
