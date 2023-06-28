<?php
#post_cat
Route::get('admin/post/cat/list', 'App\Http\Controllers\AdminCategoriesController@list');
//add
Route::post('admin/post/cat/store', 'App\Http\Controllers\AdminCategoriesController@store');
//delete
Route::get('admin/post/cat/delete/{id}', 'App\Http\Controllers\AdminCategoriesController@delete')->name('delete_category');
//edit
Route::get('admin/post/cat/edit/{id}', 'App\Http\Controllers\AdminCategoriesController@edit')->name('category.edit');
Route::post('admin/post/cat/update/{id}', 'App\Http\Controllers\AdminCategoriesController@update')->name('category.update');

#post
//add
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('admin/post/add', 'App\Http\Controllers\AdminpostController@add');
Route::post('admin/post/store', 'App\Http\Controllers\AdminpostController@store');
//edit
Route::get('admin/post/edit/{id}', 'App\Http\Controllers\AdminpostController@edit')->name('post.edit');
Route::post('admin/post/update/{id}', 'App\Http\Controllers\AdminpostController@update')->name('post.update');
//delete
Route::get('admin/post/delete/{id}', 'App\Http\Controllers\AdminpostController@delete')->name('delete_post');
Route::get('admin/post/action', 'App\Http\Controllers\AdminpostController@action');
