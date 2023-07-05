<?php

use App\Http\Controllers\CustomerRewardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationRewardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthorizedPurchaseController;
use App\Http\Controllers\RewardFormatController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DiscountController;


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
Route::group(['middleware' => ['staff', 'optimizeImages']], function () {

    //front end routes
    Route::get('/choose-option', function () {
        return view('choose-option');
    });
    Route::get('/enroll-customer', [CustomerController::class, 'enrollNewCustomer']);
    Route::post('/edit-staff/{user}', [CustomerController::class, 'editStaff']);

    //back end routes
    Route::post('/get-organization-data', [CustomerController::class, 'getRegisteredCorporateDetails']);
    Route::get('/staff-dashboard', [CustomerController::class, 'staffDashboard']);
    Route::get('/corporates', [CustomerController::class, 'getRegisteredCorporates']);
    Route::get('/edit-organization-rewards/{organization}', [OrganizationController::class, 'editOrganizationRewards'])->name('edit-organization-rewards');
    Route::get('/edit-customer-rewards/{customer}', [CustomerController::class, 'editCustomerRewards'])->name('edit-customer-rewards');
    Route::resource('organizations', OrganizationController::class);
    Route::resource('organization-rewards', OrganizationRewardController::class);
    Route::resource('customer-rewards', CustomerRewardController::class);
    Route::get('/authorized-purchases', [CustomerController::class, 'getAuthorizedPurchasesForStaff']);
    Route::get('/users', [CustomerController::class, 'showStaffs']);
    Route::get('/customers', [CustomerController::class, 'showCustomers']);
    Route::get('/vehicles', [VehicleController::class, 'showVehicles']);
    Route::get('/customers/{customer}', [CustomerController::class, 'deleteCustomer']);
    Route::get('/sales', [SaleController::class, 'getSales']);
    Route::get('/discounts', [DiscountController::class, 'getDiscounts']);
    Route::get('/automatic-discounts', [DiscountController::class, 'getAutomaticDiscounts']);
    Route::get('/redeem-discount', [DiscountController::class, 'getCustomers']);
    Route::get('/get-discount-data/{customer}', [DiscountController::class, 'getDiscountData']);
    Route::get('/set-discount', [DiscountController::class, 'setDiscount']);
    Route::get('/set-discount-status', [DiscountController::class, 'setDiscountStatus']);
    Route::get('/get-sale-data/{sale}', [SaleController::class, 'getSaleData']);
    Route::get('/make-sale', [SaleController::class, 'makeSale']);
    Route::post('/set-status', [RewardController::class, 'setStatus']);
    Route::get('/get-status', [RewardController::class, 'getStatus']);
    Route::get('/rewards', [RewardController::class, 'getRewardDetails']);
    Route::post('/edit-product', [ProductsController::class, 'editProduct']);
    Route::post('/add-staff', [CustomerController::class, 'addNewStaff']);
    Route::post('/set-reward', [RewardController::class, 'setRewardPercentage']);
    Route::post('/customer-data', [CustomerController::class, 'getCustomerData']);
    Route::post('/customer-sales-data', [CustomerController::class, 'getCustomerSalesData']);
    Route::get('/delete-staff/{user}', [CustomerController::class, 'deleteStaff']);
    Route::post('/upload-vehicle-image', [VehicleController::class, 'uploadCarImage']);
    Route::post('/customer-enrollment', [CustomerController::class, 'enrollCustomer']);
    Route::get('/get-customer-data/{customer}', [CustomerController::class, 'viewCustomerData']);
    Route::get('/get-the-vehicle-data/{vehicle}', [VehicleController::class, 'viewVehicleData']);
    Route::post('/get-staff-data/{id}', [CustomerController::class, 'getStaffData']);
    Route::post('/edit-customer/{customer}', [CustomerController::class, 'edit']);
    Route::post('/edit-vehicle/{vehicle}', [VehicleController::class, 'edit']);
    Route::post('/add-another-vehicle', [CustomerController::class, 'addAnotherVehicle']);
    Route::get('/reward-format/{product_type}/{customer}/{litres_bought}', [RewardFormatController::class, 'getRewardFormat']);
    Route::post('/edit-monthly-reward', [RewardFormatController::class, 'editMonthlyreward']);
    Route::post('/edit-bulk-reward', [RewardFormatController::class, 'editBulkreward']);
    Route::post('/set-credit-limit', [AccountController::class, 'setCreditLimit']);
    Route::post('/make-payment-or-purchase', [AccountController::class, 'makePaymentOrPurchases']);
    Route::get('/get-product/{products}', [ProductsController::class, 'getProduct']);
    Route::get('/get-reward-format/{rewardFormat}', [RewardFormatController::class, 'getSingleRewardFormat']);
    Route::post('/add-register-corporate', [CustomerController::class, 'registerCorporate']);
    Route::get('/get-corporate-users', [CustomerController::class, 'getCorporateUsers']);
    Route::post('/get-corporate-data', [CustomerController::class, 'getCorporateUserData']);
    Route::post('/set-enrollment-status', [CustomerController::class, 'setEnrollmentStatus']);
    Route::post('/set-sale-status', [CustomerController::class, 'setSaleStatus']);
    Route::post('/staff-authorize-fuel-purchase', [CustomerController::class, 'staffAuthorizeFuelPurchase']);
    Route::get('/get-number-plate', [CustomerController::class, 'autoCompleteCustomerSearch']);
    Route::get('/discount-pdf/{discountId}', [DiscountController::class, 'loadDiscountPDF']);
    Route::get('/automatic-discount-pdf/{discountId}', [DiscountController::class, 'loadAutomaticDiscountPDF']);
    Route::get('/discount-print-status/{discountId}', [DiscountController::class, 'updatePrintState']);
    Route::get('/automatic-discount-print-status/{discountId}', [DiscountController::class, 'updateAutomaticPrintState']);

});


//Corporate Customer middleware --> can only be acccessed by users with the role of Corporate
Route::group(['middleware' => 'corporate'], function () {
    //back end routes
    Route::get('/company-info', [CustomerController::class, 'getCompanyInfo']);
    Route::get('/corporate-customer-dashboard', [CustomerController::class, 'getDashboardData']);
    Route::post('/add-cooperate-employee', [CustomerController::class, 'addEmployee']);
    Route::get('/corporate-customer-employees', [CustomerController::class, 'getEmployees']);
    Route::get('/delete-cooperate-employee/{customer}', [CustomerController::class, 'deleteEmployees']);
    Route::post('/add-coorporate-vehicle', [VehicleController::class, 'addCoorporateVehicle']);
    Route::get('/corporate-customer-vehicles', [VehicleController::class, 'getCoorporateVehicle']);
    Route::get('/delete-coorporate-vehicle/{vehicle}', [VehicleController::class, 'deleteCoorporateVehicle']);
    Route::get('/corporate-customer-authorizepurchase', [CustomerController::class, 'getAuthorizedPurchases']);
    Route::get('/get-corporate-data', [CustomerController::class, 'getCoorporateData']);
    Route::post('/authorize-fuel-purchase', [CustomerController::class, 'authorizeFuelPurchase']);
    Route::get('/get-employee-data/{customer}', [CustomerController::class, 'getEmployeeData']);
    Route::get('/get-vehicle-data/{vehicle}', [VehicleController::class, 'getVehicleData']);
    Route::post('/edit-employee-data', [CustomerController::class, 'editEmployeeData']);
    Route::post('/edit-coorporate-vehicle', [VehicleController::class, 'editVehicleData']);
    Route::get('/delete-authorized-purchase/{authorizedPurchase}', [AuthorizedPurchaseController::class, 'deleteAuthorizeFuelPurchase']);
    Route::get('/my-account', [AccountController::class, 'getAccountData']);

});


Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/index', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/send-sales-sms', [CustomerController::class, 'sendSalesConfirmationSMS']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
