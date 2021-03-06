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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/publication', function () {
    return view('publication/new_publication');
});
Route::get('/these', function () {
    return view('publication/new_these');
});


Route::get('/vulgarisation', 'vulgarisationController@affichage');
Route::post('/vulgarisation','vulgarisation@traitement');

Route::get('/creationProjet','creationProjet@affichage');
Route::post('/creationProjet','creationProjet@traitement');

Route::get('/detailProjet','detailProjetController@affichage');
//Route::post('/detailProjet','detailProjetController@traitement');
