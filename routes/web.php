<?php


use Illuminate\Support\Facades\Route;
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

/*
*Здесь покоятся роуты которые должны быть под защитой
*помещяйте все роуты для которых необходима авторизация
*/
Route::group(['middleware' => ['auth']],function () {
    //admin
    Route::get('/panel','AdminController@showAllUsers')->name('admin_page');
    Route::get('/pane','AdminController@addRole')->name('add_role');
    Route::get('/panels','AdminController@deleteRoleToUser')->name('delete_role');
    Route::get('/pan','AdminController@addRoleToUser')->name('add_role_to_user');
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

    Route::post('records/submit','RecordsController@addRecord')->name('records-form');

    Route::get('records/changerole', 'RoleController@changeSelectedRole')->name('change-role');

    Route::get('/records/','RecordsController@showAllRecords')->name('records-data');

    Route::get('/records/search', 'RecordsController@searchRecord')->name('search');

    Route::get('records/show/{id}','RecordsController@showRecord')->name('record-show'); //просмотр

    Route::post('records/edit/{id}/update','RecordsController@updateSubmit')->name('record-update');

    Route::get('records/edit/{id}','RecordsController@editRecord')->name('record-edit'); //для изменения запИси

    Route::get('records/delete/{id}','RecordsController@deleteRecord')->name('record-delete');//для удаления

    Route::get('/profile','ProfileController@viewProfile')->name('profile-data');

    Route::get('/profile/{id}/changemail','ProfileController@viewChange1')->name('change-mail');

    Route::get('/profile/{id}/changepassword','ProfileController@viewChange2')->name('change-password');

    Route::post('/profile/{id}/submitM','ProfileController@changeMail')->name('change-mail-submit');

    Route::post('/profile/{id}/submitP','ProfileController@changePassword')->name('change-password-submit');




    //logout
    Route::get('/','AuthController@logout')->name('logout');
});



