<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AgentController;
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
    Route::get('/show/{user}', [UserController::class, 'show'])->name('show');

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
    Route::get('/customers', [CustomerController::class, 'indexCustomers'])->name('index.customers');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
    Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
    Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/delete/{customer}', [CustomerController::class, 'delete'])->name('destroy');

    //attachment
    Route::get('/create-attachment/{customer}', [AttachmentController::class, 'create'])->name('attachment.create');
    Route::get('/show-attachment/{attachment}', [AttachmentController::class, 'show'])->name('attachment.show');
    Route::post('/store-attachment', [AttachmentController::class, 'store'])->name('attachment.store');
    Route::delete('/delete-attachment/{attachment}', [AttachmentController::class, 'destroy'])->name('attachment.destroy');

    //follow-up
    Route::get('/follow-up', [CustomerController::class, 'indexFollow'])->name('index.follow');
    Route::post('/change-follow', [CustomerController::class, 'changeFollow'])->name('change.follow');

    //search
    Route::get('/search', [CustomerController::class, 'search'])->name('search');


    //adverser
    Route::get('/adverser', [CustomerController::class, 'indexAdverser'])->name('index.adverser');

    //committed
    Route::get('/committed', [CustomerController::class, 'indexCommitted'])->name('index.committed');

    //rejected
    Route::get('/rejected', [CustomerController::class, 'indexRejected'])->name('index.rejected');

    //Task
    Route::get('/tasks', [CustomerController::class, 'indexTask'])->name('index.task');
    Route::post('/add_task', [CustomerController::class, 'addTask'])->name('add.task');

    //import
    Route::get('/import-customers', [CustomerController::class, 'importCustomers'])->name('import');
    Route::post('/upload-customers', [CustomerController::class, 'uploadCustomers'])->name('upload');

    //export
    Route::get('export/', [CustomerController::class, 'export'])->name('export');
    Route::post('export/word', [CustomerController::class, 'exportWORD'])->name('export.WORD');
    Route::get('export/adverser', [CustomerController::class, 'exportAdverser'])->name('export.adverser');
    Route::get('export/customers', [CustomerController::class, 'exportCustomers'])->name('export.customers');
    Route::get('export/customer/{customer}', [CustomerController::class, 'exportCustomer'])->name('export.customer');
    Route::get('export/committed', [CustomerController::class, 'exportCommitted'])->name('export.committed');

});

// Transaction
Route::middleware('auth')->prefix('transactions')->name('transactions.')->group(function(){
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/All_transactions', [TransactionController::class, 'allIndex'])->name('index.all');
    Route::get('/create/{customer}', [TransactionController::class, 'create'])->name('create');
    Route::post('/store', [TransactionController::class, 'store'])->name('store');
    Route::get('/edit/{transaction}', [TransactionController::class, 'edit'])->name('edit');
    Route::put('/update/{transaction}', [TransactionController::class, 'update'])->name('update');
    Route::delete('/delete/{transaction}', [TransactionController::class, 'delete'])->name('destroy');
    Route::get('/show/{transaction}', [TransactionController::class, 'show'])->name('show');

    //get customer data
    Route::post('/get', [TransactionController::class, 'get'])->name('get');
    Route::post('/get_product', [TransactionController::class, 'getProduct'])->name('get.product');

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
    Route::get('/show/{draft}', [DraftController::class, 'show'])->name('show');

    //get customer data
    Route::post('/get', [DraftController::class, 'get'])->name('get');
    Route::post('/add_task', [DraftController::class, 'addTask'])->name('add.task');

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
    Route::get('/show/{issue}', [IssueController::class, 'show'])->name('show');
    Route::get('/All_issues', [IssueController::class, 'allIndex'])->name('index.all');
    Route::get('/create/issue/{draft}', [IssueController::class, 'createIssue'])->name('create.issue');
    Route::get('/create/issue/customer/{customer}', [IssueController::class, 'createIssueCustomer'])->name('create.issue.customer');

    //get customer data
    Route::post('/get', [IssueController::class, 'get'])->name('get');

//    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
//    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [IssueController::class, 'export'])->name('export');
    Route::get('export/word/{issue}', [IssueController::class, 'exportWORD'])->name('export.WORD');
    Route::post('export/word/ratify/{issue}', [IssueController::class, 'exportWORDRatify'])->name('export.WORD.ratify');
    Route::post('export/word/reimbursement/{issue}', [IssueController::class, 'exportWORDReimbursement'])->name('export.WORD.reimbursement');
    Route::post('export/word/reservation/{issue}', [IssueController::class, 'exportWORDReservation'])->name('export.WORD.reservation');
    Route::post('export/word/conversion/{issue}', [IssueController::class, 'exportWORDConversion'])->name('export.WORD.conversion');

});

Route::middleware('auth')->prefix('payments')->name('payments.')->group(function(){
    Route::get('/create', [PaymentController::class, 'create'])->name('create');
    Route::get('/create-customer/{customer}', [PaymentController::class, 'createPayment'])->name('create.payment');
    Route::post('/store', [PaymentController::class, 'store'])->name('store');
    Route::delete('/delete/{payment}', [PaymentController::class, 'delete'])->name('destroy');

    //get data of customer
    Route::post('/get', [PaymentController::class, 'get'])->name('get');

});

Route::middleware('auth')->prefix('stores')->name('stores.')->group(function(){
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::get('/create', [StoreController::class, 'create'])->name('create');
    Route::post('/store', [StoreController::class, 'store'])->name('store');
    Route::get('/edit/{store}', [StoreController::class, 'edit'])->name('edit');
    Route::put('/update/{store}', [StoreController::class, 'update'])->name('update');
    Route::delete('/delete/{store}', [StoreController::class, 'delete'])->name('destroy');

    Route::get('export/', [StoreController::class, 'export'])->name('export');

});

Route::middleware('auth')->prefix('agents')->name('agents.')->group(function(){
    //test
    Route::get('/', [AgentController::class, 'index'])->name('index');
    Route::get('/create', [AgentController::class, 'create'])->name('create');
    Route::post('/store', [AgentController::class, 'store'])->name('store');
    Route::get('/edit/{agent}', [AgentController::class, 'edit'])->name('edit');
    Route::put('/update/{agent}', [AgentController::class, 'update'])->name('update');
    Route::delete('/delete/{agent}', [AgentController::class, 'delete'])->name('destroy');


});
