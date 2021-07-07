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
    return view('auth/login');
})->name('login')->middleware('repeater');

//login-sumbith
Route::post('/login/submith','AuthController@login')->name('login-submith');
//registration web
Route::get('/registration',function(){
    return view('auth/registration');
})->name('registration')->middleware('repeater');
//registration-submith
Route::post('/login','AuthController@registration')->name('registration-submith');

/*
*Здесь покоятся роуты которые должны быть под защитой
*помещяйте все роуты для которых необходима авторизация
*/
Route::group(['middleware' => ['auth']],function () {
    //admin
    Route::get('/panel','AdminController@showAllUsers')->name('admin-page')->middleware('admin');
    Route::get('/panel_add_role','AdminController@addRole')->name('add-role')->middleware('admin');
    Route::get('/panel_del','AdminController@deleteRoleToUser')->name('delete-role-to-user')->middleware('admin');
    Route::get('/panel_add_role_to_user','AdminController@addRoleToUser')->name('add-role-to-user')->middleware('admin');

    //admin
    Route::get('/records/add', 'RecordController@showAddView')->name('add');

    Route::post('records/submit/', 'RecordController@addRecord')->name('records-form');

    Route::get('records/changerole',
        'RoleController@changeSelectedRole')->name('change-role');

    Route::get('/records/',
        'RecordController@showAllRecords')->name('records-data');

    Route::get('/records/search',
        'RecordController@searchRecord')->name('search');

    Route::get('records/show/{id}',
        'RecordController@showRecord')->name('record-show'); //просмотр

    Route::post('records/edit/{id}/update',
        'RecordController@updateRecord')->name('record-update');

    Route::get('records/edit/{id}',
        'RecordController@editRecord')->name('record-edit'); //для изменения запИси

    Route::get('records/delete/{id}',
        'RecordController@deleteRecord')->name('record-delete');//для удаления

    Route::get('/profile',
        'ProfileController@viewProfile')->name('profile-data');

    Route::get('/profile/{id}/changemail',
        'ProfileController@viewMailChange')->name('change-mail');

    Route::get('/profile/{id}/changepassword',
        'ProfileController@viewPasswordChange')->name('change-password');

    Route::post('/profile/{id}/submitmail',
        'ProfileController@changeMail')->name('change-mail-submit');

    Route::post('/profile/{id}/submitpassword',
        'ProfileController@changePassword')->name('change-password-submit');

    //logout
    Route::get('/','AuthController@logout')->name('logout');
});



