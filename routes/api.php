<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Resources\PostResource;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
/**
 * These are authentication route
 */

Route::group([

  'middleware' => 'api',
  'prefix' => 'auth'

], function ($router) {

  Route::post('login', [AuthController::class,'login']);
  Route::post('logout', [AuthController::class,'logout']);
  Route::post('refresh', [AuthController::class,'refresh']);
  Route::post('me', [AuthController::class,'me']);
  Route::post('register', [AuthController::class,'register']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
  
});



  /**
     * these are routes of the organization
     */

Route::post('organization',[OrganizationController::class,'postOrganization']);
Route::get('organizations',[OrganizationController::class,'getAllOrganizations']); 
Route::get('organization/{organizationId}',[OrganizationController::class,'getOrganization']);
Route::put('editorganization/{organizationId}',[OrganizationController::class,'editOrganization']);
Route::delete('deleteorganization/{organizationId}',[OrganizationController::class,'deleteOrganization']);

/**
 * These are routes for reports
 */
Route::get('reports',[ReportController::class,'getAllReports']);
Route::post('report',[ReportController::class,'postReport']);
Route::get('report/{reportId}',[ReportController::class,'getReport']);
Route::put('editreport/{reportId}',[ReportController::class,'edit']);
Route::delete('deletereport/{reportId}',[ReportController::class,'deleteReport']);
Route::get('assign/{reportId}/{organizationId}',[ReportController::class,'assignReport']);


/**
 * These are route of post class
 */
Route::group([

 'middleware' => 'auth.jwt',
  'prefix' => 'blog'

], function ($router) {
Route::post('post',[PostController::class,'create']);
Route::get('posts/{limit}',[PostController::class,'index']);
Route::get('post/{postId}',[PostController::class,'show']);
Route::put('editpost/{postId}',[PostController::class,'edit']);
Route::delete('deletepost/{postId}',[PostController::class,'destroy']);

});




/**
 * These are comment routes
 */

 Route::get('comments',[CommentController::class,'getAllComments']);
// Route::post('postcomment',[CommentController::class,'create']);
 Route::get('comment/{commentId}',[CommentController::class,'getComment']);
 Route::put('editcomment/{commentId}',[CommentController::class,'editComment']);
 Route::delete('deletecomment/{commentId}',[CommentController::class,'deleteComment']);
 /**
  * routes of comments assignment
  */

  Route::post('commentpost/{postId}',[CommentController::class,'commentPost'])->middleware('auth.jwt');
  Route::post('commentcomment/{commentId}',[CommentController::class,'commentComment'])->middleware('auth.jwt');
 /**
  * These are reaction routes
  */
  Route::get('reactions',[ReactionController::class,'getAllReaction']);
  Route::post('postreaction',[ReactionController::class,'postReaction']);
  Route::get('reaction/{reactionId}',[ReactionController::class,'getReaction']);
  Route::put('editreaction/{reactionId}',[ReactionController::class,'editReaction']);
  Route::delete('deletereaction/{reactionId}',[ReactionController::class,'deleteReaction']);
  Route::get('assignpost/{postId}',[ReactionController::class,'assignPost']);
  Route::get('assigncomment/{reactionId}/{commentId}',[ReactionController::class,'assignComment']);




//  Route::get('/email/verify', function () {
//   return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// email verification handler

//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
 // $request->fulfill();
//return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');

// resend link to verify email
//Route::post('/email/verification-notification', function (Request $request) {
 //$request->user()->sendEmailVerificationNotification();

//   return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
