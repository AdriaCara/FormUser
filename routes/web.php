<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controllerRoutes;
use App\Http\Controllers\ControllerData;


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

Route::get('form', [controllerRoutes::class, 'form']);
Route::post('saveData', [ControllerData::class, 'validateData']);