<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login']);

//login
Route::post('/login', [AuthController::class, 'login']);

//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//company
Route::get('/company', [App\Http\Controllers\Api\CompanyController::class, 'show'])->middleware('auth:sanctum');

//Check in
Route::get('/checkin', [App\Http\Controllers\Api\AttendaceController::class,'checkin'])->middleware('auth:sanctum');

//Check out
Route::get('/checkout', [App\Http\Controllers\Api\AttendaceController::class,'checkout'])->middleware('auth:sanctum');


// isCheckedin
Route::get('/is-checkin', [App\Http\Controllers\Api\AttendaceController::class,'isCheckedin'])->middleware('auth:sanctum');

//update profile
Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

//create permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

//notes
Route::apiResource('/api-notes', App\Http\Controllers\Api\NoteController::class)->middleware('auth:sanctum');


