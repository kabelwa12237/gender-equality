<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
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
Route::post('organization', [OrganizationController::class, 'store']);
Route::get('organization/{organizationId}', [OrganizationController::class, 'show']);
Route::put('organization/{organizationId}', [OrganizationController::class, 'edit']);
Route::delete('organization/{organizationId}', [OrganizationController::class, 'destroy']);


/**
 * Report Routes
 */
Route::get('reports', [ReportController::class, 'index']);
Route::post('report', [ReportController::class, 'store']);
Route::get('report/{reportId}', [ReportController::class, 'show']);
Route::put('report/{reportId}', [ReportController::class, 'edit']);
Route::delete('report/{reportId}', [ReportController::class, 'destroy']);
/**Assignments */
Route::get('assignreport/{reportId}/{organizationId}', [ReportController::class, 'assignReport']);


/**
 * Post Routes
 */
Route::get('posts', [PostController::class, 'index']);
Route::post('post', [PostController::class, 'store']);
Route::get('post/{postId}', [PostController::class, 'show']);
Route::put('post/{postId}', [PostController::class, 'edit']);
Route::delete('post/{postId}', [PostController::class, 'destroy']);

/**
 * Comment Routes
 */
Route::get('comments',[CommentController::class, 'index']);
Route::get('comment/{commentId}',[CommentController::class, 'show']);
Route::put('comment/{commentId}',[CommentController::class, 'edit']);
Route::delete('comment/{commentId}', [CommentController::class, 'destroy']);
/**Assignments */
Route::post('commentpost/{postId}', [CommentController::class, 'commentPost']);
Route::post('commentcomment/{commentId}', [CommentController::class, 'commentComment']);


/**
 * Reaction Routes
 */
Route::get('reactions',[ReactionController::class, 'index']);
Route::post('reaction', [ReactionController::class, 'store']);
Route::get('reaction/{reactionId}',[ReactionController::class, 'show']);
Route::put('reaction/{reactionId}',[ReactionController::class, 'edit']);
Route::delete('reaction/{reactionId}', [ReactionController::class, 'destroy']);
/**Assignments */
Route::get('reactpost/{reactionId}/{postId}', [ReactionController::class, 'reactPost']);
Route::get('reactcomment/{reactionId}/{commentId}', [ReactionController::class, 'reactComment']);




