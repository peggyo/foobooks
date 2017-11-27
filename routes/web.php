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

Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    $debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
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
* Route::get('/book/', 'BookController@index');
* Route::get('/book/{title}', 'BookController@show');
*/

/**
* Book

*Route::get('/book/create', 'BookController@create');
*Route::post('/book', 'BookController@store');
*Route::get('/book', 'BookController@index');
*Route::get('/book/{title}', 'BookController@show');
*Route::get('/search', 'BookController@search');


* Example relates to namespaces and classes - see BookController for notes in comments
*Route::get('/example', 'BookController@example');
*/

/**
* Book
*/
# Create a book
Route::get('/book/create', 'BookController@create');
Route::post('/book', 'BookController@store');
# Edit a book
Route::get('/book/{id}/edit', 'BookController@edit');
Route::put('/book/{id}', 'BookController@update');

# Delete a book
Route::any('/book/{id}/delete', 'BookController@delete');

# View all books
Route::get('/book', 'BookController@index');
# View a book
Route::get('/book/{id}', 'BookController@show');
# Search all books
Route::get('/search', 'BookController@search');



/**
* Example portion of Foobooks that mirrors what you'll do for P3
*/

Route::get('/trivia/', 'TriviaController@index');       ///////TRY REMOVING THE SECOND / ??? that's how the book index is accessed???
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');

/*============================================================================================*/
#<?php
/**
* Code from Week 7 progress log
*/
/*
Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});
*/
/**
* Practice
*/
/*
Route::get('/practice/6', 'PracticeController@practice6');
Route::any('/practice/{n?}', 'PracticeController@index');
*/
/**
* Example portion of Foobooks that mirrors what you'll do for P3
*/
/*
Route::get('/trivia/', 'TriviaController@index');
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');
*/
/**
* Homepage
*/
/* Route::get('/', 'WelcomeController');
*/
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
