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
  Route::put('/userupdate/{id}', [\App\Http\Controllers\Auth\EditUserController::class, 'update']);
    Route::put('/users/{user}', [\App\Http\Controllers\Auth\EditUserController::class, 'update']);
    Route::resource('/job',\App\Http\Controllers\JobController::class);
    Route::resource('/resumes', \App\Http\Controllers\Seeker\ResumeController::class);
  });

Route::middleware(['auth:sanctum', 'role:seeker'])->group(function () {
    Route::resource('/application', \App\Http\Controllers\Seeker\ApplicationController::class);
    Route::resource('/Offers',\App\Http\Controllers\Seeker\OfferController::class);
    Route::resource('/Hires',\App\Http\Controllers\Seeker\HireController::class);
    Route::resource('/Interviews',\App\Http\Controllers\Seeker\InterviewController::class);
    Route::resource('/preferenceCategory', \App\Http\Controllers\Seeker\PreferenceCategoryController::class);
});

Route::middleware(['auth:sanctum', 'role:specialist'])->group(function () {
    Route::resource('/specialistJobs',\App\Http\Controllers\Specialist\JobSpecialistController::class);
    Route::resource('/specialistApplication',\App\Http\Controllers\Specialist\ApplicationSpecialistController::class);
    Route::resource('/specialistInterviews',\App\Http\Controllers\Specialist\InterviewSpecialistController::class);
    Route::resource('/specialistOffers',\App\Http\Controllers\Specialist\OfferSpecialistController::class);
    Route::resource('/specialistHires',\App\Http\Controllers\Specialist\HireSpecialistController::class);
    Route::resource('/SeekerBySpecialist', \App\Http\Controllers\Specialist\SeekerBySpecialistController::class);
    Route::resource('/dashboardData', \App\Http\Controllers\Specialist\DashboardDataController::class);
});


Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('/admin/seekers', \App\Http\Controllers\Admin\AdminSeekerController::class);
    Route::resource('/admin/specialists', \App\Http\Controllers\Admin\AdminSpecialistController::class);
    Route::resource('/admin/category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/admin/country', \App\Http\Controllers\Admin\CountryController::class);
    Route::resource('/admin/city', \App\Http\Controllers\Admin\CityController::class);
    Route::resource('/admin/applications', \App\Http\Controllers\Admin\AdminApplicationController::class);
    Route::resource('/admin/jobs', \App\Http\Controllers\Admin\AdminJobController::class);
    Route::resource('/admin/interviews', \App\Http\Controllers\Admin\AdminInterviewController::class);
    Route::resource('/admin/offers', \App\Http\Controllers\Admin\AdminOfferController::class);
    Route::resource('/admin/hires', \App\Http\Controllers\Admin\AdminHireController::class);
    Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);

});


//Public APIs
Route::get('specialists',[\App\Http\Controllers\SpecialistController::class,'index']);
Route::get('joblist',[\App\Http\Controllers\JobController::class,'indexForGuest']);
Route::get('/jobinfo/{id}', [\App\Http\Controllers\JobController::class, 'showForGust']);
Route::get('categorylist',[\App\Http\Controllers\Admin\CategoryController::class,'indexForGuest']);
Route::get('countrylist',[\App\Http\Controllers\Admin\CountryController::class,'indexForGuest']);
Route::get('citylist',[\App\Http\Controllers\Admin\CityController::class,'indexForGuest']);
Route::get('citylistbycountry/{countryId}',[\App\Http\Controllers\Admin\CityController::class,'indexForGuestByCountry']);