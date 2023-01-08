<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Category;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Permission;

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
// Frontend Routes
Route::get('/', [FrontendController::class, "index"])->name('frontend.home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
// Backend Routes
Route::get('/dashboard', [BackendController::class, 'index'])->middleware('auth')->name('backend.home');

Route::get('dashboard/role', [RolePermissionController::class, 'index'])->name('backend.role.index');
Route::get('dashboard/create/role', [RolePermissionController::class, 'create'])->name('backend.role.create');
Route::post('dashboard/store/role', [RolePermissionController::class, 'store'])->name('backend.role.store');


// Category Routes
Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/show/{category}', 'show')->name('show');
    Route::get('/edit/{category}', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::put('/update/{category}', 'update')->name('update');
    Route::delete('/delete/{category}', 'destroy')->name('delete');
    Route::get('/restore/{id}', 'restore')->name('restore');
    Route::delete('/permanent/{id}', 'permanentDelete')->name('permanent.delete');

});


// Post Routes
Route::controller(PostController::class)->prefix('post')->name('post.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/show/{post}', 'show')->name('show');
    Route::get('/edit/{post}', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::put('/update/{post}', 'update')->name('update');
    Route::delete('/delete/{post}', 'destroy')->name('delete');
    Route::get('/restore/{id}', 'restore')->name('restore');
    Route::delete('/permanent/{id}', 'permanentDelete')->name('permanent.delete');

});


// optional route
Route::post('dashboard/create/permission', [RolePermissionController::class, 'storePermission'])->name('backend.permission.store');

// backend user route
Route::get('dashboard/users', [userController::class, 'index'])->name('backend.user.index');




Route::middleware('auth')->group(function(){
    Route::get('user/edit/{id}', function(){
        echo "User Edit";
    })->middleware(['permission:edit']);
    
    Route::get('user/view/{id}', function(){
        echo "User View";
    })->middleware(['permission:seen']);
    
    Route::get('user/delete/{id}', function(){
        echo "User Delete";
    })->middleware(['permission:delete']);
});






// test route

// Route::get('/test', function(){

//     $role = Role::find(4);
//     $user = User::find(4);

//     $role->givePermissionTo(4);
// });