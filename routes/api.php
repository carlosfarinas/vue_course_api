<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;



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

// Users
Route::get('/users/all', [UserController::class, "getUsers"]);
Route::post('/users/create', [UserController::class, "addUser"]);

// Surveys
Route::get('/surveys/all', [SurveyController::class, "getSurveys"])->name('get-surveys');
Route::post('/surveys/create', [SurveyController::class, "addSurvey"]);


