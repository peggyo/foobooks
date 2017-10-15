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

/**
* Debugbar: shows examples of using the debugbar package
*/
Route::get('/debugbar', function () {

    $data = ['foo' => 'bar'];
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';
});


/**
* Environment - examples of settings
*/
Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

/**
* Practice
*/
Route::any('/practice/{n?}', 'PracticeController@index');


/**
* Welcome
*/
#Route::get('/', 'WelcomeController@index'); // if using index function of controller
Route::get('/', 'WelcomeController');  // if using __invoke of WelcomeController


/**
* BookController
*/
Route::get('/book/', 'BookController@index');
Route::get('/book/{title}', 'BookController@show');

# Example relates to namespaces and classes - see BookController for notes in comments
Route::get('/example', 'BookController@example');


/*============================================================================================*/
/* Earlier example that does not use controllers:
Route::get('/', function () {
    return view('welcome');
});

Route::get('/book/', function() {
    return 'Show all books.';
});

Route::get('/book/{title}', function($title) {
    return 'You have requested '.$title.'.';
});
*/

/* Shows how to make a parameter optional:
 * title is parameter, it is needed in the function.
 * because it is needed, set default in closure to
 * be used if title does not exist.
Route::get('/book/{title?}', function($title = '') {
    return 'You have requested '.$title;
});
*/
/*
Route::get('/', function () {
    return 'Open ..\public\index.php';
});
*/
