<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CcController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\OgController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cc/all', [CcController::class, 'getAll']);
Route::post('/cc/select', [CcController::class, 'getSelect']);
Route::post('/cc/dd', [CcController::class, 'getAllDd']);

Route::get('/guide/all', [GuideController::class, 'getAll']);
Route::post('/guide/select', [GuideController::class, 'getSelect']);

Route::get('/insurance/all', [InsuranceController::class, 'getAll']);
Route::post('/insurance/select', [InsuranceController::class, 'getSelect']);

Route::get('/pack/getAllCategorys', [PackController::class, 'getAllCategorys']);
Route::post('/pack/getChars', [PackController::class, 'getChars']);
Route::post('/pack/presearch', [PackController::class, 'presearch']);
Route::post('/pack/search', [PackController::class, 'search']);

Route::post('/export/presearch', [ExportController::class, 'presearch']);
Route::post('/export/search', [ExportController::class, 'search']);

Route::post('/og/presearch', [OgController::class, 'presearch']);
Route::post('/og/search', [OgController::class, 'search']);

Route::middleware('auth:sanctum')->post('/checkLogin', function(Request $request){
    return response(['auth' => 'ok'], 200);
});

Route::middleware('auth:sanctum')->post('/admin/cc/all', [CcController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/cc/create', [CcController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/cc/update', [CcController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/cc/delete', [CcController::class, 'adminDelete']);

Route::middleware('auth:sanctum')->post('/admin/cc/dd/all', [CcController::class, 'adminDdAll']);
Route::middleware('auth:sanctum')->post('/admin/cc/dd/create', [CcController::class, 'adminDdCreate']);
Route::middleware('auth:sanctum')->post('/admin/cc/dd/update', [CcController::class, 'adminDdUpdate']);
Route::middleware('auth:sanctum')->post('/admin/cc/dd/delete', [CcController::class, 'adminDdDelete']);

Route::middleware('auth:sanctum')->post('/admin/export/all', [ExportController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/export/create', [ExportController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/export/update', [ExportController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/export/delete', [ExportController::class, 'adminDelete']);

Route::middleware('auth:sanctum')->post('/admin/guide/all', [GuideController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/guide/create', [GuideController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/guide/update', [GuideController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/guide/delete', [GuideController::class, 'adminDelete']);

Route::middleware('auth:sanctum')->post('/admin/insurance/all', [InsuranceController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/insurance/create', [InsuranceController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/insurance/update', [InsuranceController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/insurance/delete', [InsuranceController::class, 'adminDelete']);

Route::middleware('auth:sanctum')->post('/admin/og/all', [OgController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/og/create', [OgController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/og/update', [OgController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/og/delete', [OgController::class, 'adminDelete']);

Route::middleware('auth:sanctum')->post('/admin/pack/all', [PackController::class, 'adminAll']);
Route::middleware('auth:sanctum')->post('/admin/pack/create', [PackController::class, 'adminCreate']);
Route::middleware('auth:sanctum')->post('/admin/pack/update', [PackController::class, 'adminUpdate']);
Route::middleware('auth:sanctum')->post('/admin/pack/delete', [PackController::class, 'adminDelete']);