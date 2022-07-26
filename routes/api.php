<?php

use App\Http\Controllers\API\MahasiswaController;
use App\Models\Mahasiswa;
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
Route::get('Mahasiswa',[MahasiswaController::class,'index']);
Route::post('Mahasiswa/store',[MahasiswaController::class,'store']);
Route::get('Mahasiswa/show/{id}',[MahasiswaController::class,'show']);
Route::post('Mahasiswa/update/{id}',[MahasiswaController::class,'update']);
Route::get('Mahasiswa/destroy/{id}',[MahasiswaController::class,'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
