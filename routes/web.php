<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about',function(){
    return view('about');
})->name('about');

Route::get('/default',function(){
    return view('welcome');
});

//login web
Route::get('/login',function(){
    return view('login');
})->name('login');
//login-sumbith
Route::post('/login/submith','AuthController@login')->name('login-submith');
//registraion web
Route::get('/registraion',function(){
    return view('registraion');
})->name('registraion');
//registraion-submith
Route::post('/login','AuthController@registration')->name('registraion-submith');

Route::get('/records/add', function(){
    return view('add');
})->name('add');

/* Заглушка
Route::post('contact/submit', function(){
    dd(Request::all());
})->name('contact-form');//Именованное определение Url адреса
*/
Route::post('records/submit','RecordsController@addRecord')->name('records-form');
Route::get('records/','RecordsController@showAllRecords')->name('records-data');

Route::get('records/search', 'RecordsController@searchRecord')->name('record-search');

Route::get('records/show/{id}','RecordsController@showRecord')->name('record-show'); //просмотр

Route::post('records/edit/{id}/update','RecordsController@updateSubmit')->name('record-update'); 
Route::get('records/edit/{id}','RecordsController@editRecord')->name('record-edit'); //для изменения запИси
Route::get('records/delete/{id}','RecordsController@deleteRecord')->name('record-delete');//для удаления

//Route::post('contact/submith','ContactController@submith')->name('contact-form'); //чё за субмитх?//Паша=> это очень старый роут тестовый, можно удалить если не нид
Route::get('contact/myInfo','ContactController@myInfo')->name('contact-data');



