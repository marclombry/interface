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
})->name('resinet');

Auth::routes();



// Route qui permet de connaître la langue active
Route::get('locale', 'LocalizationController@getLang')->name('getlang');

// Route qui permet de modifier la langue
Route::get('locale/{lang}', 'LocalizationController@setLang')->name('setlang');

// Route qui amene à l'accueil
Route::get('/home', 'HomeController@index')->name('home');
// Route qui permet de choisir par categorie
Route::get('/home/category/{category}','HomeController@category')->name('category');
// Route qui amene au favoris
Route::get('/home/user/favoris', 'FavoriteController@show')->name('favoris');
// Route quand on ajout un favorie
Route::get('/home/favorite/id/{id}', 'FavoriteController@store')->name('add_favorite');
// Route quand on supprime un favorie
Route::get('/home/favorite/delete/id/{id}', 'FavoriteController@delete')->name('sup_favorite');

// Route administration
Route::middleware(['auth'])->group(function () {
    Route::get('/home/powa/','AdminController@index')->name('admin');

    // Route pour ajouter une tuiles
    Route::post('/home/powa/box','AdminController@addBox')->name('add_box');
    // Route pour ajouter une categories
    Route::post('/home/powa/category','AdminController@addCategory')->name('add_categories');
    // Route pour ajouter une categories
    Route::post('/home/powa/group','AdminController@addGroup')->name('add_groupes');

    // Route de suppresion
    Route::get('/home/powa/delete/box/{id}', 'AdminController@deleteBox')->name('sup_box');

    Route::get('/home/powa/delete/category/{id}', 'AdminController@deleteCategory')->name('sup_cat');

    Route::get('/home/powa/delete/group/{id}', 'AdminController@deleteGroup')->name('sup_group');

    Route::get('/home/powa/delete/user/{id}', 'AdminController@deleteUser')->name('sup_user');

    Route::get('/home/powa/delete/historic/{id}', 'AdminController@deleteHistoric')->name('sup_historic');


    //Route de modification
    Route::post('/home/powa/update/box/','AdminController@updateBox')->name('up_box');

    Route::post('/home/powa/update/category/','AdminController@updateCategories')->name('up_categories');

    Route::post('/home/powa/update/group/','AdminController@updateGroup')->name('up_groupes');

    Route::post('/home/powa/update/users/','AdminController@updateUser')->name('up_users');

    //Route ajax
    Route::post('home/ajax','AjaxController@index')->name('ajax');
});
