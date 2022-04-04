<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;


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




//Staff middleware --> can only be acccessed by users with the role of Staff
Route::group(['middleware' => 'staff'], function()
{

    //staff dashboard routes
    Route::get('/authorized-purchases', function () {
        return view('staff.authorized-purchases');
    });
    Route::get('/staff-dashboard', function () {
        return view('staff.dashboard');
    });
    Route::get('/users', function () {
        return view('staff.users');
    });
    Route::get('/ordinary-customers', function () {
        return view('staff.ordinary-customers');
    });
    Route::get('/sales', function () {
        return view('staff.sales');
    });


    //front end routes
    Route::get('/choose-option', function () {
        return view('choose-option');
    });
    Route::get('/enroll-customer', function () {
        return view('enroll-customer');
    });

    Route::get('/make-sale', function () {
        return view('make-sale');
    });

    Route::post('/customer-enrollment',  [CustomerController::class,'enrollCustomer']);
    Route::post('/upload-vehicle-image', [VehicleController::class,'uploadCarImage']);
    Route::post('/customer-data', [CustomerController::class,'getCustomerData']);






});

//Corporate Customer middleware --> can only be acccessed by users with the role of Corporate
Route::group(['middleware' => 'corporate'], function()
{
   // cooperate customer routes
    Route::get('/cooperate-customer-dashboard', function () {
        return view('cooperate-customer.dashboard');
    });
    Route::get('/cooperate-customer-employees', function () {
        return view('cooperate-customer.employees');
    });
    Route::get('/cooperate-customer-vehicles', function () {
        return view('cooperate-customer.vehicles');
    });
    Route::get('/cooperate-customer-rewards', function () {
        return view('cooperate-customer.rewards');
    });

});


//can be accessed by anyone
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/index', function () {
    return view('auth.login');
});

Route::get('/password-reset', function () {
    return view('password-reset');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/send-sms', [CustomerController::class,'sendConfirmationSMS']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
