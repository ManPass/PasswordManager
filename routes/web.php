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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about',function(){
    return view('about');
})->name('about');

Route::get('/contact',function(){
    return view('contact');
})->name('contact');

Route::get('/default',function(){
    return view('welcome');
});

/* Заглушка
Route::post('contact/submit', function(){
    dd(Request::all());
})->name('contact-form');//Именованное определение Url адреса
*/
Route::post('contact/submith','ContactController@submith')->name('contact-form');
Route::get('contact/myInfo','ContactController@myInfo')->name('contact-data');