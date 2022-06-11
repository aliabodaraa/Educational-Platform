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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth'/*, 'permission'*/]], function() {
            /**
             * Logout Routes
             */
            Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

            /**
             * User Routes
             */
            Route::group(['prefix' => 'users'], function() {
                Route::get('/', 'UsersController@index')->name('users.index');
                Route::get('/create', 'UsersController@create')->name('users.create');
                Route::post('/create', 'UsersController@store')->name('users.store');
                Route::get('/{user}/show', 'UsersController@show')->name('users.show');
                Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
                Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
                Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            });

            /**
             * Post Routes
             */
            Route::group(['prefix' => 'posts'], function() {
                Route::get('/', 'PostsController@index')->name('posts.index');
                Route::get('/create', 'PostsController@create')->name('posts.create');
                Route::post('/create', 'PostsController@store')->name('posts.store');
                Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
                Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
                Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
                Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
            });

            /**
             * Course Routes
             */
            Route::group(['prefix' => 'courses'], function() {
                Route::get('/chooseYearDept', 'CoursesController@chooseYearDept')->name('courses.chooseYearDept');
                Route::post('/chooseYearDept', 'CoursesController@storeChooseYearDept')->name('courses.chooseYearDept');
                Route::get('/', 'CoursesController@index')->name('courses.index');
                Route::get('/year/{year}', 'CoursesController@indexYear')->name('courses.indexYear');
                Route::get('/dept/{dept}', 'CoursesController@indexDept')->name('courses.indexDept');
                Route::get('/semester/{semester}', 'CoursesController@indexSemester')->name('courses.indexSemester');
                Route::get('/dept/{dept}/year/{year}', 'CoursesController@indexDeptYear')->name('courses.indexDeptYear');
                Route::get('/dept/{dept}/semester/{semester}', 'CoursesController@indexDeptSemester')->name('courses.indexDeptSemester');
                Route::get('/year/{year}/semester/{semester}', 'CoursesController@indexYearSemester')->name('courses.indexYearSemester');
                Route::get('/dept/{dept}/year/{year}/semester/{semester}', 'CoursesController@indexDeptYearSemester')->name('courses.indexDeptYearSemester');
                Route::get('/create', 'CoursesController@create')->name('courses.create');
                Route::post('/create', 'CoursesController@store')->name('courses.store');
                Route::get('/{course}/show', 'CoursesController@show')->name('courses.show');
            });

            /**
             * Lectures Routes
             */
            Route::group(['prefix' => 'lectures'], function() {
                Route::get('/', 'LecturesController@index')->name('lectures.index');
                Route::get('/create', 'LecturesController@create')->name('lectures.create');
                Route::post('/create', 'LecturesController@store')->name('lectures.store');
                Route::get('/{file}/download', 'LecturesController@download')->name('lectures.download');//http://127.0.0.1:8000/lectures/lecture-1654189222.pdf/download
                Route::get('/{file}/display', 'LecturesController@display')->name('lectures.display');
                Route::delete('/{lecture}/delete', 'LecturesController@destroy')->name('lectures.destroy');
            });

            Route::resource('roles', RolesController::class);
            Route::resource('permissions', PermissionsController::class);
    });
});
