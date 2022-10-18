<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\IssueController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');


    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');

});

// Customer
Route::middleware('auth')->prefix('customers')->name('customers.')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
    Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
    Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/delete/{customer}', [CustomerController::class, 'delete'])->name('destroy');

    //adverser
    Route::get('/adverser', [CustomerController::class, 'indexAdverser'])->name('index.adverser');

    //Task
    Route::get('/tasks', [CustomerController::class, 'indexTask'])->name('index.task');
    Route::post('/add_task', [CustomerController::class, 'addTask'])->name('add.task');

    //import
//    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
//    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    //export
    Route::get('export/', [CustomerController::class, 'export'])->name('export');
    Route::get('export/adverser', [CustomerController::class, 'exportAdverser'])->name('export.adverser');

});

// Transaction
Route::middleware('auth')->prefix('transactions')->name('transactions.')->group(function(){
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/create', [TransactionController::class, 'create'])->name('create');
    Route::post('/store', [TransactionController::class, 'store'])->name('store');
    Route::get('/edit/{transaction}', [TransactionController::class, 'edit'])->name('edit');
    Route::put('/update/{transaction}', [TransactionController::class, 'update'])->name('update');
    Route::delete('/delete/{transaction}', [TransactionController::class, 'delete'])->name('destroy');

    //get customer data
    Route::post('/get', [TransactionController::class, 'get'])->name('get');

//    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
//    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [TransactionController::class, 'export'])->name('export');

});

// Draft
Route::middleware('auth')->prefix('drafts')->name('drafts.')->group(function(){
    Route::get('/', [DraftController::class, 'index'])->name('index');
    Route::get('/create', [DraftController::class, 'create'])->name('create');
    Route::post('/store', [DraftController::class, 'store'])->name('store');
    Route::get('/edit/{draft}', [DraftController::class, 'edit'])->name('edit');
    Route::put('/update/{draft}', [DraftController::class, 'update'])->name('update');
    Route::delete('/delete/{draft}', [DraftController::class, 'delete'])->name('destroy');

    //get customer data
    Route::post('/get', [DraftController::class, 'get'])->name('get');

//    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
//    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [DraftController::class, 'export'])->name('export');

});

// Issue
Route::middleware('auth')->prefix('issues')->name('issues.')->group(function(){
    Route::get('/', [IssueController::class, 'index'])->name('index');
    Route::get('/create', [IssueController::class, 'create'])->name('create');
    Route::post('/store', [IssueController::class, 'store'])->name('store');
    Route::get('/edit/{issue}', [IssueController::class, 'edit'])->name('edit');
    Route::put('/update/{issue}', [IssueController::class, 'update'])->name('update');
    Route::delete('/delete/{issue}', [IssueController::class, 'delete'])->name('destroy');

    //get customer data
    Route::post('/get', [IssueController::class, 'get'])->name('get');

//    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
//    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [IssueController::class, 'export'])->name('export');

});
