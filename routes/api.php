<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReportController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Organization Routes
 */
Route::get('organizations', [OrganizationController::class, 'index']);
Route::post('postorganization', [OrganizationController::class, 'store']);
Route::get('getorganization/{organizationId}', [OrganizationController::class, 'show']);
Route::put('editorganization/{organizationId}', [OrganizationController::class, 'edit']);
Route::delete('deleteorganization/{organizationId}', [OrganizationController::class, 'destroy']);


/**
 * Report Routes
 */
Route::get('reports', [ReportController::class, 'index']);
Route::post('postreport', [ReportController::class, 'store']);
Route::get('getreport/{reportId}', [ReportController::class, 'show']);
Route::put('editreport/{reportId}', [ReportController::class, 'edit']);
Route::delete('deletereport/{reportId}', [ReportController::class, 'destroy']);
Route::get('getassignreport/{reportId}/{organizationId}', [ReportController::class, 'assignReport']);
