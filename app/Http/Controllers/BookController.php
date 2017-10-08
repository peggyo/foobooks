<?php

namespace App\Http\Controllers;
#Another alternative to tell this controller to look for Hash in the global namespace is:
#use Hash;      // Then the extra '\' in the example method is not necessary

use Illuminate\Http\Request;

class BookController extends Controller
{
    # Return and index of all books
    public function index() {
        return 'BookController says: Show all books.';
    }

    # Return information about a specific title (book)
    public function show($title) {
        return 'BookController says: You requested '.$title;
    }

    # Example of invoking a class not in the current namespace:
    # Without the '\' preceding 'Hash' an error occurs Because
    # the Hash class is in the global namespace, but not the current.
    # The '\' tells code to look in the global namespace. See top
    # of file for alternative "use Hash" WITHOUT the '\'
    public function example() {
        return \Hash::make('anystring');
    }

} #eoc
