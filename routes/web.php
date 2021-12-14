<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServicePro
vider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');
// Route::get('/test', 'TestController@index');

Route::group([
	'namespace' => 'Auth'
], function(){
	Route::get('/login', function () { return view('auth.login'); })->name('login');
	Route::post('/login', 'AuthController@login')->name('login.submit');
	Route::get('/sign-in/{user}', 'AuthController@signIn')->name('sign-in');
	Route::post('/logout', 'AuthController@logout')->name('logout');
});

Route::group([
	'prefix' => 'admin',
	'as' => 'admin.',
	'middleware' => ['auth', 'admin'],
	'namespace' => 'Admin'
], function(){
	Route::resource('jenis-vaksin', 'JenisVaksinController');
	Route::resource('pevaksin', 'PevaksinController');
	Route::resource('tempat-vaksin', 'TempatVaksinController');
	Route::resource('vaksinasi-pertama', 'VaksinasiPertamaController');
	Route::resource('vaksinasi-kedua', 'VaksinasiKeduaController');
	Route::group([
		'prefix' => 'search',
		'as' => 'search.',
	], function(){
		Route::get('search-user', 'SearchController@user')->name('user');
		Route::get('search-tempat', 'SearchController@tempat')->name('tempat-vaksin');
		Route::get('search-pevaksin', 'SearchController@pevaksin')->name('pevaksin');
	});	
});

Route::group([
	'prefix' => 'pevaksin',
	'as' => 'pevaksin.',
	'middleware' => ['auth', 'pevaksin'],
	'namespace' => 'Pevaksin'
], function(){
	Route::resource('vaksinasi-pertama', 'VaksinasiPertamaController');
	Route::resource('vaksinasi-kedua', 'VaksinasiKeduaController');
	Route::group([
		'prefix' => 'search',
		'as' => 'search.',
	], function(){
		Route::get('search-user', 'SearchController@user')->name('user');
		Route::get('search-tempat', 'SearchController@tempat')->name('tempat-vaksin');
		Route::get('search-pevaksin', 'SearchController@pevaksin')->name('pevaksin');
	});	
});

Route::group([
	'prefix' => 'user',
	'as' => 'user.',
	'middleware' => ['auth'],
	'namespace' => 'User'
], function(){
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('profil', 'ProfilController@index')->name('profil');
	Route::group([
		'prefix' => 'sertifikat',
		'as' => 'sertifikat.',
	], function(){
		Route::get('vaksinasi-pertama', 'SertifikatController@pertama')->name('pertama');
		Route::get('vaksinasi-kedua', 'SertifikatController@kedua')->name('kedua');
	});	
});