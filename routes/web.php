<?php

use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
//Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/terms', function(){
    return view('terms');
});
Route::get('/contact', function(){
    return view('contact');
});
Route::get('/email_confirm/{username}', [App\Http\Controllers\HomeController::class, 'emailConfirmation'])->name('emailConfirmation');
Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications');
Route::get('/messages', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');
Route::get('/{username}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/{username}/deleteAccount', [App\Http\Controllers\HomeController::class, 'deleteAccount'])->name('deleteAccount');
Route::post('/{username}/updateAvatar', [App\Http\Controllers\EditProfileController::class, 'editAvatar'])->name('editAvatar');
Route::post('/{username}/updateBackground', [App\Http\Controllers\EditProfileController::class, 'editBackground'])->name('editBackground');
Route::get('/{username}/edit-profile-basic', [App\Http\Controllers\EditProfileController::class, 'editProfileBasic'])->name('editProfileBasic');
Route::post('/{username}/updateProfileBasic', [App\Http\Controllers\EditProfileController::class, 'updateProfileBasic'])->name('updateProfileBasic');
Route::get('/{username}/changePassword', [App\Http\Controllers\EditProfileController::class, 'changePassword'])->name('changePassword');
Route::post('/{username}/updatePassword', [App\Http\Controllers\EditProfileController::class, 'updatePassword'])->name('updatePassword');
Route::post('/{username}/follow', [App\Http\Controllers\RelController::class, 'follow'])->name('follow');
Route::post('/{username}/follow-ajax', [App\Http\Controllers\RelController::class, 'follow_ajax'])->name('follow_ajax');
Route::post('/{username}/unfollow', [App\Http\Controllers\RelController::class, 'unfollow'])->name('unfollow');
Route::get('/{username}/followers', [App\Http\Controllers\EditProfileController::class, 'followers'])->name('followers');
Route::get('/{username}/following', [App\Http\Controllers\EditProfileController::class, 'following'])->name('following');
Route::get('/{username}/posts', [App\Http\Controllers\EditProfileController::class, 'posts'])->name('posts');
Route::post('/{username}/posts/addPost', [App\Http\Controllers\EditProfileController::class, 'addPost'])->name('addPost');
Route::post('/like', [App\Http\Controllers\PublicationController::class, 'like'])->name('like');
Route::post('/unlike', [App\Http\Controllers\PublicationController::class, 'unlike'])->name('unlike');
Route::post('/comment', [App\Http\Controllers\PublicationController::class, 'comment'])->name('comment');
Route::post('/search-form', [App\Http\Controllers\HomeController::class, 'search_form'])->name('search_form');
Route::post('/deleteNotification', [App\Http\Controllers\HomeController::class, 'deleteNotification'])->name('deleteNotification');
Route::post('/deletePost', [App\Http\Controllers\PublicationController::class, 'deletePost'])->name('deletePost');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
