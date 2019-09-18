<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('clients', 'ClientController@index')->name('frontend.client.index');
    Route::get('clients/create', 'ClientController@createView')->name('frontend.client.createView');
    Route::post('clients/create', 'ClientController@create')->name('frontend.client.create');
    Route::get('clients/edit/{id}', 'ClientController@editView')->name('frontend.client.editView');
    Route::post('clients/edit/{id}', 'ClientController@edit')->name('frontend.client.edit');
});