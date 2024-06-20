<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/job',\App\Http\Controllers\JobController::class);
    Route::resource('/category',\App\Http\Controllers\CategoryController::class);
    Route::resource('/country',\App\Http\Controllers\CountryController::class);
    Route::resource('/city',\App\Http\Controllers\CityController::class);
    Route::resource('/application',\App\Http\Controllers\ApplicationController::class);
});


//Public APIs
Route::get('joblist',[\App\Http\Controllers\JobController::class,'indexForGuest']);
Route::get('categorylist',[\App\Http\Controllers\CategoryController::class,'indexForGuest']);
Route::get('countrylist',[\App\Http\Controllers\CountryController::class,'indexForGuest']);
Route::get('citylist',[\App\Http\Controllers\CityController::class,'indexForGuest']);
Route::get('citylistbycountry/{countryId}',[\App\Http\Controllers\CityController::class,'indexForGuestByCountry']);