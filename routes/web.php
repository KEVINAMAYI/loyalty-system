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
