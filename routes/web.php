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

Route::get('/registraion',function(){
    return view('registraion');
})->name('registraion');

Route::get('/default',function(){
    return view('welcome');
});
//login
Route::get('/login',function(){
    return view('login');
})->name('login');
/* Заглушка
Route::post('contact/submit', function(){
    dd(Request::all());
})->name('contact-form');//Именованное определение Url адреса
*/
Route::post('contact/submith','ContactController@submith')->name('contact-form');
Route::get('contact/myInfo','ContactController@myInfo')->name('contact-data');