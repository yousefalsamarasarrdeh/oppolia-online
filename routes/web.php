<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminUserManagement;
use App\Http\Controllers\Dashboard\DesignerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\OrderController;
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/users', [AdminUserManagement::class, 'index_Datatabel'])->name('admin.users.index');
    Route::get('/admin/users_main', [AdminUserManagement::class, 'main_index'])->name('admin.users.index.main');
    Route::get('/users/{user}/edit', [AdminUserManagement::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserManagement::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserManagement::class, 'destroy'])->name('users.destroy');


    // إضافة طرق لـ DesignerController مع تحديد الأسماء
    Route::get('/admin/designers', [DesignerController::class, 'index'])->name('admin.designers.index');
    Route::delete('/admin/designers/{designer}', [DesignerController::class, 'destroy'])->name('admin.designers.destroy');
    Route::get('designer/edit/{user}', [DesignerController::class, 'showEditForm'])->name('designer.showEditForm');
    Route::post('designer/update/{user}', [DesignerController::class, 'storeOrUpdateDesigner'])->name('designer.storeOrUpdate');
    Route::get('designer/show/{user}', [DesignerController::class, 'showDesigner'])->name('designer.show');

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


Route::middleware(['auth'])->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});
Route::middleware(['admin_or_designer'])->group(function () {
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
});

Route::get('set/lang/{lang}',function ($lang){
    if(in_array($lang,['en','ar'])) {
        setcookie('lang',$lang,time()+(68*24*365),'/');
    }
    return redirect()->back();
}) ;




Route::middleware(['set-locale'])->group(function () {


    Route::get('/', function () {
        return view('welcome');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index1'])->name('home');
Route::get('/testotp', [App\Http\Controllers\HomeController::class, 'testotp']);

Route::get('/verify-otp/{phone}', [RegisterController::class, 'showOtpVerifyPage'])->name('otp.verify.page');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('otp.verify');





// عرض صفحة إدخال رمز OTP باستخدام GET
Route::get('otp/verify', [LoginController::class, 'showVerifyForm'])->name('otp.verify.log-page');

// التحقق من رمز OTP المدخل باستخدام POST
Route::post('otp/verify', [LoginController::class, 'verifyOTP'])->name('otp.verify.log');
