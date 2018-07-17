<?php

use App\Http\Middleware\IsAdmin;


Route::get('/', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@pointage')->name('pointage');

Route::get('/logout', 'LoginController@logout')->name('logout');


Route::group(['middleware' => [IsAdmin::class]], function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/','AdminController@index')->name('admin.index');

        Route::get('/comptables','AdminController@allComptables')->name('admin.allcomptables');
        Route::get('/pointages','AdminController@allPointages')->name('admin.allpointages');

        Route::get('/comptable/{matricule}','AdminController@getOneComptable')->name('admin.comptable');
        Route::post('/comptable/{matricule}','AdminController@updateComptable')->name('admin.comptable.update');

    });
});