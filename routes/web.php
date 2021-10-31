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


Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index');
Route::get('/matches/{id}', 'MatchesController@show')->name('match.show');
Route::get('/news/{id}', 'NewsController@show')->name('news.show');
Route::get('/players/{id}', 'HomeController@index');
Route::get('/matches', 'MatchesController@index')->name('matches');
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/players', 'HomeController@index')->name('players');


//Route::get('/post/{id}', 'HomeController@show')->name('post.show');
//Route::get('/tag/{id}', 'HomeController@tag')->name('tag.show');
//Route::get('/category/{id}', 'HomeController@category')->name('category.show');
//Route::post('/subscribe', 'SubsController@subscribe');
//Route::get('/verify/{token}', 'SubsController@verify');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');


    Route::get('/logout', 'AuthController@logout');
    Route::post('/comment', 'CommentsController@store');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->middleware('isAllowed:view-admin-dashboard');
    Route::resource('/categories', 'CategoriesController')->middleware('isAllowed:edit-admin-dashboard');

//       Route::resource('tags', 'TagsController')->middleware('isAllowed:delete-admin-dashboard');
    Route::get('/tags', 'TagsController@index')->name('tags.index');
    Route::get('/tags/create', 'TagsController@create')->name('tags.create');
    Route::post('/tags', 'TagsController@store')->name('tags.store');
    Route::get('/tags/{tags}', 'TagsController@show')->name('tags.show');
    Route::get('/tags/{tags}/edit', 'TagsController@edit')->name('tags.edit');
    Route::put('/tags/{tags}', 'TagsController@update')->name('tags.update');
    Route::patch('/tags/{tags}', 'TagsController@update')->name('tags.update');
    Route::delete('/tags/{tags}', 'TagsController@destroy')->name('tags.destroy');

    Route::get('/users/{users}/password/edit', 'UsersController@passwordEdit')->name('users.password-edit');
    Route::post('/users/{users}/password', 'UsersController@passwordUpdate')->name('users.password-store');
    Route::resource('/users', 'UsersController')->middleware('isAllowed:view-admin-dashboard');

    Route::resource('/players', 'PlayersController')->middleware('isAllowed:view-admin-dashboard');
    Route::resource('/posts', 'PostsController')->middleware('isAllowed:view-admin-dashboard');
    Route::resource('/matches', 'MatchesController')->middleware('isAllowed:view-admin-dashboard');
    Route::get('/comments', 'CommentsController@index')->middleware('isAllowed:view-admin-dashboard');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle')->middleware('isAllowed:view-admin-dashboard');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::resource('/subscribers', 'SubscribersController')->middleware('isAllowed:view-admin-dashboard');
});

Auth::routes(['verify' => true]);
