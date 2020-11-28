<?php

Route::prefix('company')->group(function () {
    Route::get('/', 'CompanyController@index')->name('companies');
    Route::get('create', 'CompanyController@create')->name('create_company');
    Route::post('store', 'CompanyController@store')->name('store_company');
    Route::get('edit/{company}', 'CompanyController@edit')->name('edit_company');
    Route::get('show/{company}', 'CompanyController@show')->name('show_company');
    Route::put('update/{company}', 'CompanyController@update')->name('update_company');
    Route::delete('destroy/{company}', 'CompanyController@destroy')->name('destroy_company');
});


Route::prefix('employ')->group(function () {
    Route::get('/', 'EmployController@index')->name('employees');
    Route::get('create', 'EmployController@create')->name('create_employ');
    Route::post('store', 'EmployController@store')->name('store_employ');
    Route::get('edit/{employ}', 'EmployController@edit')->name('edit_employ');
    Route::get('show/{employ}', 'EmployController@show')->name('show_employ');
    Route::put('update/{employ}', 'EmployController@update')->name('update_employ');
    Route::delete('destroy/{employ}', 'EmployController@destroy')->name('destroy_employ');
});
