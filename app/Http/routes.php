<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function() {
    return view('auth.login');
});

// Authentication routes...
Route::get('login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login'
]);

Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as' => 'logout'
]);

// Registration routes...
Route::get('register', [
    'uses' => 'Auth\AuthController@getRegister',
    'as' => 'register'
]);
Route::post('register', 'Auth\AuthController@postRegister');


/*
 *
 */
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


/*
 * PRUEBA: Indentificar si un usuario esta conectado
 * Grupos de rutas de laravel
 * app/Http/Kernel.php
 */

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin', [
        'uses' => 'AdminController@index',
        'as' => 'panel'
    ]);

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::resource('colecciones', 'FormsController');
        Route::resource('complements', 'ComplementsController');
        Route::resource('inputs', 'InputsController');

        // DIBUJAR FORMULARIO
        Route::get('coleccion/{id}/form', [
            'uses' => 'InputsController@drawForm',
            'as' => 'form'
        ]);

        // SAVE FORMULARIO
        Route::get('coleccion/form/{id}/new', [
            'uses' => 'DvarcharController@storeFormData',
            'as' => 'admin.colecciones.form.data.store'
        ]);

        // SHOW DATA FROM COLLECTION
        Route::get('coleccion/form/{id}/lista', [
            'uses' => 'DvarcharController@index',
            'as' => 'admin.colecciones.form.data.index'
        ]);

        // DESTROY ROW DATA
        Route::delete('coleccion/form/lista/row/{id}/delete', [
            'uses' => 'DvarcharController@destroy',
            'as' => 'admin.colecciones.form.data.list.destroy'
        ]);

    });


});





