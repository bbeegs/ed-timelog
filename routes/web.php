<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObservationRecordController;
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

Route::get('/', [ObservationRecordController::class, 'index']);
Route::get('/observations/create', [ObservationRecordController::class, 'create']);
Route::post('/observations',[ObservationRecordController::class, 'store']);
Route::get('/observations/{observation}/edit',[ObservationRecordController::class, 'edit']);
Route::put('/observations/{observation}', [ObservationRecordController::class, 'update']);
Route::delete('/observations/{observation}', [ObservationRecordController::class, 'destroy']);
