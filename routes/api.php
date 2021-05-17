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







//organization rouutes

Route::get('organizations', [OrganizationController::class, 'index']);
Route::post('addorganization', [OrganizationController::class, 'create']);
Route::get('organization/{organizationId}', [OrganizationController::class, 'show']);
Route::put('editorganization/{organizationId}', [OrganizationController::class, 'edit']);

Route::delete('deleteorganization/{organizationId}', [OrganizationController::class, 'destroy']);



//reports routes


Route::get(
    'reports',
    [ReportController::class, 'index']
);
Route::post('postReport', [ReportController::class, 'create']);

Route::get('report/{reportId}', [ReportController::class, 'show']);
Route::put('updateReport/{reportId}', [ReportController::class, 'edit']);
Route::delete('deletereport/{reportId}', [ReportController::class, 'destroy']);
Route::get('assignReport/{reportId}/{organizationId}', [ReportController::class, 'assign']);
