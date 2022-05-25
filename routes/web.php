<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PersonalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\FilterController;


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

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::group(['middleware' => ['language']], function() {
    //language
    Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');

    //homepage
    Route::get('/', [FrontController::class, 'getHome'])->name('home');

    Auth::routes();
    // Authentication Routes...
    // $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // $this->post('login', 'Auth\LoginController@login');
    // $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    // $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // $this->post('register', 'Auth\RegisterController@register');

    // // Password Reset Routes...
    // $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    // $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    // $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    // $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    
    //Note writer
    Route::get('/note/{note_id}/writer', [NotesController::class, 'writer'])->name('note.writer'); 
    
    //Note show 
    Route::get('/{note}/details', [NotesController::class, 'details'])->name('note.details');

    Route::get('/faculties/filter', [FilterController::class, 'filterFaculties']);
    Route::get('/filter', [FilterController::class, 'filter'])->name('filter');    
    Route::get('/get/faculties', [FilterController::class, 'getFaculties']);
});

Route::group(['middleware' => ['auth','language']], function () {
    //CRUD operations on profiles
    Route::get('/user/myprofile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/user/myprofile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user/myprofile/update', [ProfileController::class, 'update'])->name('profile.update');

    //User Notes 
    Route::get('/user/mynotes/downloaded', [PersonalizationController::class, 'downloaded'])->name('user.mynotes.downloaded');
    Route::get('/user/mynotes/uploaded', [PersonalizationController::class, 'uploaded'])->name('user.mynotes.uploaded');
    Route::get('user/mynotes/uploaded/{note}', [PersonalizationController::class, 'uploaded_note'])->name('user.mynotes.myuploadednote');
    Route::get('user/mynotes/downloaded/{note}', [PersonalizationController::class, 'downloaded_note'])->name('user.mynotes.mydownloadednote');

    //Follow
    Route::get('/writer/{user}/follow', [PersonalizationController::class, 'follow'])->name('writer.follow');
    Route::get('/writer/{user}/unfollow', [PersonalizationController::class, 'unfollow'])->name('writer.unfollow');

    //CRUD operations on Notes
    Route::resource('note', '\App\Http\Controllers\NotesController');
    Route::get('/note/{note}/delete/confirm', [NotesController::class, 'confirmDestroy'])->name('note.confirmDestroy');
    Route::get('/user/mynotes/downloaded/{note}/score', [NotesController::class, 'updateNoteScore'])->name('note.score');
    Route::get('/user/mynotes/uploaded/{note}/edit', [NotesController::class, 'update'])->name('note.update');
    Route::get('/user/{note}/download', [NotesController::class, 'download'])->name('note.download');
    Route::get('/user/{note}/delete', [NotesController::class, 'delete'])->name('note.delete');

});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
