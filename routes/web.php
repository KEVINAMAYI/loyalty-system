<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthorizedPurchaseController;

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
    //front end routes
    Route::get('/choose-option', function () { return view('choose-option'); });
    Route::get('/enroll-customer', function () { return view('enroll-customer'); });
    Route::post('/edit-staff/{user}',  [CustomerController::class,'editStaff']);


    //back end routes
    Route::get('/staff-dashboard', [CustomerController::class,'staffDashboard']);
    Route::get('/authorized-purchases',[CustomerController::class,'getAuthorizedPurchasesForStaff']);
    Route::get('/users', [CustomerController::class,'showStaffs']);
    Route::get('/customers', [CustomerController::class,'showCustomers']);
    Route::get('/customers/{customer}', [CustomerController::class,'deleteCustomer']);
    Route::get('/sales', [SaleController::class,'getSales']);
    Route::get('/get-sale-data/{sale}', [SaleController::class,'getSaleData']);
    Route::get('/make-sale',[SaleController::class,'makeSale']);
    Route::post('/set-status', [RewardController::class,'setStatus']);
    Route::get('/get-status', [RewardController::class,'getStatus']);
    Route::get('/rewards', [RewardController::class,'getRewardDetails']);
    Route::post('/add-staff', [CustomerController::class,'addNewStaff']);
    Route::post('/set-reward', [RewardController::class,'setRewardPercentage']);
    Route::post('/customer-data', [CustomerController::class,'getCustomerData']);
    Route::post('/customer-sales-data', [CustomerController::class,'getCustomerSalesData']);
    Route::get('/delete-staff/{user}', [CustomerController::class,'deleteStaff']);
    Route::post('/upload-vehicle-image', [VehicleController::class,'uploadCarImage']);
    Route::post('/customer-enrollment',  [CustomerController::class,'enrollCustomer']);
    Route::get('/get-customer-data/{customer}',  [CustomerController::class,'viewCustomerData']);
    Route::post('/get-staff-data/{id}',  [CustomerController::class,'getStaffData']);
    Route::post('/edit-customer/{cutomer}',  [CustomerController::class,'edit']);
    Route::post('/add-another-vehicle',  [CustomerController::class,'addAnotherVehicle']);



});

//Corporate Customer middleware --> can only be acccessed by users with the role of Corporate
Route::group(['middleware' => 'corporate'], function()
{
     //back end routes
    Route::get('/cooperate-customer-dashboard', [CustomerController::class,'getDashboardData']);
    Route::post('/add-cooperate-employee',  [CustomerController::class,'addEmployee']);
    Route::get('/cooperate-customer-employees',  [CustomerController::class,'getEmployees']);
    Route::get('/delete-cooperate-employee/{customer}',  [CustomerController::class,'deleteEmployees']);
    Route::post('/add-coorporate-vehicle',  [VehicleController::class,'addCoorporateVehicle']);
    Route::get('/cooperate-customer-vehicles', [VehicleController::class,'getCoorporateVehicle']);
    Route::get('/delete-coorporate-vehicle/{vehicle}', [VehicleController::class,'deleteCoorporateVehicle']);
    Route::get('/cooperate-customer-authorizepurchase',[CustomerController::class,'getAuthorizedPurchases']);
    Route::get('/get-corporate-data',[CustomerController::class,'getCoorporateData']);
    Route::post('/authorize-fuel-purchase',[CustomerController::class,'authorizeFuelPurchase']);
    Route::get('/get-employee-data/{customer}',[CustomerController::class,'getEmployeeData']);
    Route::get('/get-vehicle-data/{vehicle}',[VehicleController::class,'getVehicleData']);
    Route::post('/edit-employee-data',[CustomerController::class,'editEmployeeData']);
    Route::post('/edit-coorporate-vehicle',[VehicleController::class,'editVehicleData']);
    Route::get('/delete-authorized-purchase/{authorizedPurchase}',[AuthorizedPurchaseController::class,'deleteAuthorizeFuelPurchase']);


});


//can be accessed by anyone
Route::get('/register', function () { return view('auth.register'); });
Route::get('/index', function () { return view('auth.login'); });
Route::get('/password-reset', function () { return view('password-reset'); });
Route::get('/', function () { return view('auth.login'); });
Route::get('/login', function () { return view('auth.login'); });
Route::post('/send-sales-sms', [CustomerController::class,'sendSalesConfirmationSMS']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
