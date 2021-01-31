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

//get関数 第一引数でURLを指定、第二引数には関連付ける処理をする。
// ここでは無名関数(クロージャ)が指定されている。クロージャ内にはviewヘルパ関数で[welcome]の名前のviewを呼び出す処理を記述している。
Route::get('/', function () {
    return view('welcome');
});

// ['verify' => true]をつけて、メール認証を有効にする。
// Auth\VerificationControllerにロジックがある。
Auth::routes(['verify' => true]);

// indexは省略してアクセスできるようにするのが一般的なので、/home/indexとはせず、/homeだけにしている。
Route::get('/home', 'HomeController@index')->name('home');

// パスワード変更
Route::get('/setting/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.form');
Route::post('/setting/change', 'Auth\ChangePasswordController@ChangePassword')->name('password.change');

// ユーザー削除
Route::get('/setting/deactive', 'Auth\DeactiveController@showDeactiveForm')->name('deactive.form');
Route::post('/setting/deactive', 'Auth\DeactiveController@deactive')->name('deactive');

Route::get('/setting', 'SettingController@index')->name('setting');

// 氏名変更
Route::get('/setting/name','SettingController@showChangeNameForm')->name('name.form');
Route::post('/setting/name','SettingController@ChangeName')->name('name.change');

// ユーザーネーム変更
Route::get('/setting/username','SettingController@showChangeUserNameForm')->name('username.form');
Route::post('/setting/username','SettingController@ChangeUserName')->name('username.change');

// メールアドレス変更
Route::get('/setting/email','SettingController@showChangeMailForm')->name('email.form');
Route::post('/setting/email','SettingController@ChangeEmail')->name('email.change');

// 画像アップロード
Route::get('/setting/show','SettingController@imageshow')->name('show.form');
Route::post('/upload','SettingController@upload')->name('upload');

// 画像一覧
Route::get('/list','ImageListController@show')->name('image_list');

// 投稿

Route::resource('post', 'PostsController', ['only' => ['index', 'show','create','store','edit','update','destroy']]);

// コメント

Route::resource('comment', 'CommentsController',['only' => ['store']]);