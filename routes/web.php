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
Route::resource('kontak','Kontak');
Route::resource('file','File');
Route::get('/', function () {
    return view('index');
});
Route::get('/halaman-kedua', function () {
    return view('halamandua');
});
Route::get('/home_user', 'User@index');
Route::get('/login', 'User@login');
Route::post('/loginPost', 'User@loginPost');
Route::get('/register', 'User@register');
Route::post('/registerPost', 'User@registerPost');
Route::get('/logout', 'User@logout');

//email
Route::get('/email', function () {
    return view('send_email');
});
Route::post('/sendEmail', 'Email@sendEmail');

//RESTFUL API
Route::get('/kontak','Kontak@index');
Route::get('/kontak/{id}','Kontak@show');
Route::post('/kontak/store','Kontak@store');
Route::post('/kontak/update/{id}','Kontak@update');
Route::post('/kontak/delete/{id}','Kontak@destroy');