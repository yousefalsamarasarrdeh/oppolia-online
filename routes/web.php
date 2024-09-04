<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminUserManagement;
use App\Http\Controllers\Dashboard\DesignerController;
use App\Http\Controllers\Dashboard\CategoryController;

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
Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index1'])->name('home');
