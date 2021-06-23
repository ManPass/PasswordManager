<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Crypt;
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

//login web
Route::get('/login',function(){
    return view('login');
})->name('login')->middleware('repeater');

//login-sumbith
Route::post('/login/submith','AuthController@login')->name('login-submith');
//registraion web
Route::get('/registration',function(){
    return view('registraion');
})->name('registraion')->middleware('repeater');
//registraion-submith
Route::post('/login','AuthController@registration')->name('registraion-submith');



//Route::post('contact/submith','ContactController@submith')->name('contact-form'); //чё за субмитх?//Паша=> это очень старый роут тестовый, можно удалить если не нид


/*
*Здесь покоятся роуты которые должны быть под защитой
*помещяйте все роуты для которых необходима авторизация
*/
Route::group(['middleware' => ['auth']],function () {
    //admin
    Route::get('/panel','adminController@showAllUsers')->name('admin_page');
    Route::get('/pane','adminController@addRole')->name('add_role');
    //admin
    Route::get('/records/add', function(){
        return view('add');
    })->name('add');
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/default',function(){
        return view('welcome');
    });
    //Route::get('contact/myInfo','ContactController@myInfo')->name('contact-data');

    Route::post('records/submit','RecordsController@addRecord')->name('records-form');

    Route::get('/records','RecordsController@showAllRecords')->name('records-data');

    Route::get('/records/search', 'RecordsController@searchRecord')->name('search');

    Route::get('records/show/{id}','RecordsController@showRecord')->name('record-show'); //просмотр

    Route::post('records/edit/{id}/update','RecordsController@updateSubmit')->name('record-update');

    Route::get('records/edit/{id}','RecordsController@editRecord')->name('record-edit'); //для изменения запИси

    Route::get('records/delete/{id}','RecordsController@deleteRecord')->name('record-delete');//для удаления
   
    Route::get('/profile','ProfileController@viewProfile')->name('profile-data');

    Route::get('/profile/{id}/change-mail','ProfileController@viewChange1')->name('change-mail');

    Route::get('/profile/{id}/change-password','ProfileController@viewChange1')->name('change-password');

    Route::post('/profile/{id}/submitM','ProfileController@changeMail')->name('change-mail-submit');

    Route::post('/profile/{id}/submitP','ProfileController@changePassword')->name('change-password-submit');
    

    //logout
    Route::get('/','AuthController@logout')->name('logout');
});



