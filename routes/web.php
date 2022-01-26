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

// Karyawan

//GET
Route::get('/', 'KaryawanController@index');
Route::get('/karyawan', 'KaryawanController@index');
Route::get('/karyawan/create', 'KaryawanController@create');
Route::get('/karyawan/details/{id}', 'KaryawanController@show');
Route::get('/karyawan/{id}/edit', 'KaryawanController@edit');
Route::get('/karyawan/word-export/{id}', 'KaryawanController@wordExport');

// POST
Route::post('/karyawan', 'KaryawanController@store');

// PUT
Route::put('/karyawan/{id}', 'KaryawanController@update');

// DELETE
Route::delete('/karyawan/{id}', 'KaryawanController@destroy');