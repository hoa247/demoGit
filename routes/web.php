<?php

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

Route::get("home",function(){
	return view('welcome');
});
Route::get('/','demo2\Controller_member@list_member');
Route::post('add_ajax','demo2\Controller_member@add_ajax');
Route::post('edit_ajax/{id}','demo2\Controller_member@edit_ajax');
Route::get('delete_member','demo2\Controller_member@delete_member');
Route::get('edit_member','demo2\Controller_member@edit_member');
Route::get('sort','demo2\Controller_member@sort');
Route::get('load_member', 'demo2\Controller_member@load_member');