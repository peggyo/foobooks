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


#Route::get('/', 'WelcomeController@index'); // if using index function of controller
Route::get('/', 'WelcomeController');  // if using __invoke of WelcomeController
Route::get('/book/', 'BookController@index');
Route::get('/book/{title}', 'BookController@show');

# Example relates to namespaces and classes - see BookController for notes in comments
Route::get('/example', 'BookController@example');


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
