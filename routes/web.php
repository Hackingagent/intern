<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;



Auth::routes();

Route::get('/', [GuestController::class, 'welcome'])->name('welcome');
Route::get('/login', [GuestController::class, 'login'])->name('login');
Route::get('/AccType', [GuestController::class, 'selectAccType'])->name('selectAccType');
Route::get('/CreateCompanyAcc', [GuestController::class, 'createComAcc'])->name('createComAcc');
Route::get('/CreateStudentAcc', [GuestController::class, 'createStuAcc'])->name('createStuAcc');
Route::post('/storeStuData', [GuestController::class, 'CreateNewStudent']);
Route::post('/storeComData', [GuestController::class, 'CreateNewCompany']);
Route::post('/logincheck',[GuestController::class, 'LoginCheck'] );
Route::get('see-more', [GuestController::class, 'seeMore'])->name('seeMore');


Route::prefix('Company')->name('Company.')->group(function(){
    Route::middleware(['auth:company'])->group(function(){
        Route::view('/home', 'Company.addvacancy')->name('home');
        Route::get('/logout', [CompanyController::class, 'logout'])->name('logout');
        Route::post('/storevacancy', [CompanyController::class, 'AddVacancy'])->name('storevacancy');
        Route::get('/myposts', [CompanyController::class, 'MyPosts'])->name('myposts');
        Route::get('/editvacancy/{vacancy_id}', [CompanyController::class, 'EditVacancy'])->name('editvacancy');
        Route::post('/updatevacancy/{vacancy_id}', [CompanyController::class, 'UpdateVacancy'])->name('updatevacancy');
        Route::get('/deletevacancy/{vacancy_id}', [CompanyController::class, 'DeleteVacancy'])->name('deletevacancy');
        Route::get('/aboutmycompany', [CompanyController::class, 'AboutMyCompany'])->name('aboutmycompany');
        Route::post('/editComData', [CompanyController::class, 'EditCompanyData'])->name('editComData');
        Route::get('/deletemyaccount', [CompanyController::class, 'DeleteMyAccount'])->name('deletemyaccount');
        Route::get('/message', [CompanyController::class, 'AllMessages'])->name('message');
        Route::get('/seenmsg', [CompanyController::class, 'SeenMsg'])->name('seenmsg');
        Route::get('/msgbody', [CompanyController::class, 'MsgBody'])->name('msgbody');
        Route::post('/sendmsg', [CompanyController::class, 'SendMsg'])->name('sendmsg');
        Route::get('/comnotification', [CompanyController::class, 'Notification'])->name('comnotification');
        Route::get('/readNotification', [CompanyController::class, 'ReadNotification'])->name('readNotification');
    });
});

Route::prefix('Student')->name('Student.')->group(function(){
    Route::middleware(['auth:student'])->group(function(){
        Route::view('/home', 'Student.home')->name('home');
        Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
        Route::get('/feed', [StudentController::class, 'StuFeed'])->name('StuFeed');
        Route::get('/aboutme', [StudentController::class, 'AboutMe'])->name('AboutMe');
        Route::post('/editStuData', [StudentController::class, 'EditStudentData'])->name('editStuData');
        Route::get('/deletemyaccount',[StudentController::class, 'DeleteMyAccount'])->name('deletemyaccount');
        Route::get('/addfavorite', [StudentController::class, 'AddToFav'])->name('addfavorite');
        Route::get('/favorite', [StudentController::class, 'Favorite'])->name('favorite');
        Route::get('/removefavorite', [StudentController::class, 'Removefavorite'])->name('removefavorite');
        Route::get('/seemore', [StudentController::class, 'SeeMore'])->name('seemore');
        Route::get('/message', [StudentController::class, 'AllMessages'])->name('message');
        Route::get('/seenmsg', [StudentController::class, 'SeenMsg'])->name('seenmsg');
        Route::get('/msgbody', [StudentController::class, 'MsgBody'])->name('msgbody');
        Route::post('/sendmsg', [StudentController::class, 'SendMsg'])->name('sendmsg');

        Route::post('/apply-perform/{id}', [StudentController::class, 'Apply'])->name('apply.perform');

        Route::get('/stuNotification', [StudentController::class, 'Notification'])->name('stuNotification');
        Route::get('/readNotification', [StudentController::class, 'ReadNotification'])->name('readNotification');

        Route::get('/apply/{id}', [StudentController::class, 'showApply'])->name('student.apply');

    });
});