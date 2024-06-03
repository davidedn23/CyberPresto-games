<?php

use App\Models\Announcement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;


//rotta home
Route::get('/', [PublicController::class, 'home'])->name('home');

//Detail
Route::get('/announcement/show/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');
Route::get('/announcement/index/{category}{categoryName}', [AnnouncementController::class, 'index'])->name('announcement.index');
Route::get('/announcement/indexAll/', [AnnouncementController::class, 'indexAll'])->name('announcement.indexAll');
Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

// Rotte revisor

Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware('IsRevisor')->name('revisor.index');
Route::patch('/accept/{announcement}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{announcement}', [RevisorController::class, 'reject'])->name('reject');
Route::patch('/reset', [RevisorController::class, 'reset'])->name('reset');


Route::middleware(['auth'])->group(function () {
    Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->name('revisor.request');

    //User delete
    Route::delete('/users/destroy', [PublicController::class, 'userDestroy'])->name('user.destroy');

    //Announcement create
    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');
});

// search
Route::get('/announcement/search', [AnnouncementController::class, 'search'])->name('announcement.search');

//Selezione linguaggio
Route::post('/lingua/{lang}',[PublicController::class, 'setLanguage'])->name('setLocale');

