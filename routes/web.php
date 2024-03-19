<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route to display the welcome view
Route::get('/', function () {
    return redirect('login');
});

Auth::routes(); // Laravel's built-in authentication routes

// Define routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('accept.eula'); // Home/dashboard route, only accessible to authenticated users
    Route::get('/eula', 'EulaController@show')->name('eula'); // Route to display the EULA
    Route::post('/eula/accept', 'EulaController@accept')->name('eula.accept'); // Route to handle EULA acceptance form submission
});
