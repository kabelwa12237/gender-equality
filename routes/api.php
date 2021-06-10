<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;


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
 * Aunthentication Routes
 */
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login'] );
    Route::post('register', [AuthController::class, 'register'] );
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});



/**
 * Organization Routes
 */
Route::get('organizations', [OrganizationController::class, 'getAllOrganizations']);
Route::post('organization', [OrganizationController::class, 'postSingleOrganization']);
Route::get('organization/{organizationId}', [OrganizationController::class, 'getSingleOrganization']);
Route::put('editorganization/{organizationId}', [OrganizationController::class, 'editSingleOrganization']);
Route::delete('deleteorganization/{organizationId}', [OrganizationController::class, 'deleteSingleOrganization']);


/**
 * Report Routes
 */
Route::get('reports', [ReportController::class, 'allReports']);
Route::post('report', [ReportController::class, 'postSingleReport']);
Route::get('report/{reportId}', [ReportController::class, 'getSingleReport']);
Route::put('editreport/{reportId}', [ReportController::class, 'editSingleReport']);
Route::delete('deletereport/{reportId}', [ReportController::class, 'deleteSingleReport']);
/**Assignments */
Route::get('assignreport/{reportId}/{organizationId}', [ReportController::class, 'assignReport']);


/**
 * Post Routes
 */
Route::group([

    //'middleware' => 'auth.jwt',
    'prefix' => 'blog'

], function ($router) {

    Route::get('posts/{limit}', [PostController::class, 'getAllPosts']);
    Route::post('post', [PostController::class, 'postSinglePost']);
    Route::get('post/{postId}', [PostController::class, 'getSinglePost']);
    Route::put('post/{postId}', [PostController::class, 'editSinglePost']);
    Route::delete('post/{postId}', [PostController::class, 'deleteSinglePost']);
});


/**
 * Comment Routes
 */
Route::get('comments', [CommentController::class, 'getAllComments']);
Route::get('comment/{commentId}', [CommentController::class, 'getSingleComment']);
Route::put('editcomment/{commentId}', [CommentController::class, 'editSingleComment']);
Route::delete('deletecomment/{commentId}', [CommentController::class, 'deleteSingleComment']);
/**Assignments */
Route::post('commentpost/{postId}', [CommentController::class, 'commentPost'])->middleware('auth.jwt');
Route::post('commentcomment/{commentId}', [CommentController::class, 'commentComment'])->middleware('auth.jwt');


/**
 * Reaction Routes
 */
Route::get('reactions', [ReactionController::class, 'getAllReactions']);
Route::post('reaction', [ReactionController::class, 'postSingleReaction']);
Route::get('reaction/{reactionId}', [ReactionController::class, 'getSingleReaction']);
Route::put('editreaction/{reactionId}', [ReactionController::class, 'editSingleReaction']);
Route::delete('deletereaction/{reactionId}', [ReactionController::class, 'deleteSingleReaction']);
/**Assignments */
Route::get('reactpost/{postId}', [ReactionController::class, 'reactPost']);
Route::get('reactcomment/{commentId}', [ReactionController::class, 'reactComment']);
