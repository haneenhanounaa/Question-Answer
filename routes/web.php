<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TagsController;
use \App\Http\Controllers\QuestionController;
use \App\Http\Controllers\UserProfileController;
use \App\Http\Controllers\AnswerController;
use \App\Http\Middleware\Localization;
use \App\Http\Controllers\NotificationsController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','password.confirm'])->name('dashboard');


Route::get('/',[QuestionController::class,'index']);


require __DIR__.'/auth.php';



Route::group([
    //'middleware'=>['locale'], وقف الشغل يلي اعملته قبل علشان بدي استخدم المكتبة يلي نزلتها
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath']
],function(){


    Route::prefix('tags')->as('tags.')->group(function (){
        Route::get('/',[TagsController::class,'index'])->name('index');
        Route::get('/create',[TagsController::class,'create'])->name('create');
        Route::post('',[TagsController::class,'store'])->name('store');
        Route::get('/{id}/edit',[TagsController::class,'edit'])->name('edit');
        Route::put('/{id}',[TagsController::class,'update'])->name('update');
        Route::delete('/{id}',[TagsController::class,'destroy'])->name('destroy');

    });

    Route::middleware('auth')->group(function () {



        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit2');
        Route::put('/profile', [UserProfileController::class, 'update']);
//        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');



        Route::post('answers',[AnswerController::class,'store'])
           ->name('answers.store');

        Route::put('answers/{id}/best',[AnswerController::class,'best'])
            ->name('answers.best');


        Route::get('/notifications', [NotificationsController::class, 'index'])
            ->name('notifications');


    });


    Route::resource('questions',QuestionController::class);

//    Route::get('/',[QuestionController::class,'index']);

//    Route::get('profile',[UserProfileController::class,'edit'])
//        ->name('profile')->middleware('auth');
//    Route::put('profile',[UserProfileController::class,'update'])
//        ->middleware('auth');


});
