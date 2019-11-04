<?php

use Illuminate\Http\Request;

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


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::get('logout','API\UserController@logOut');

    Route::group(['prefix'=>'biography'],function (){
        Route::post('create_bio','API\BiografiController@create');
        Route::get('get_bio','API\BiografiController@getBiography');
        Route::post('edit_bio','API\BiografiController@editBiography');
        Route::post('delete_bio','API\BiografiController@delete');
    });
    Route::group(['prefix'=>'ProfilePhoto'],function (){
        Route::post('create_photo','API\ProfilePhotoController@create');
        Route::get('get_photo','API\ProfilePhotoController@getPhoto');
        Route::post('update_photo','API\ProfilePhotoController@updatePhoto');
        Route::post('delete_photo','API\ProfilePhotoController@deletePhoto');
    });

    Route::group(['prefix'=>'posts'],function (){
       Route::post('create_post','API\PostController@create');
       Route::get('get_posts','API\PostController@getPosts');
       Route::get('get_post/{id}','API\PostController@getPost');
       Route::post('update_post/{id}','API\PostController@updatePost');
       Route::get('delete_post/{id}','API\PostController@delete');
    });

    Route::group(['prefix'=>'comments'],function (){
        Route::post('create_comment','API\CommentController@create');
    });
});
