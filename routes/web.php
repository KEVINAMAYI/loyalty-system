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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/login', function () {
    return view('cooperate-customer.index');
});

//staff routes
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


