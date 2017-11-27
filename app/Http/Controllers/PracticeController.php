<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;
use App\Book;


class PracticeController extends Controller
{

    /**
    *  Take a look at the Books Collection
    */
    public function practice12()
    {
        # Get all rows
        $books = Book::all();
        echo 'dump $books';
        dump($books);

        echo 'dump $books->toArray';
        dump($books->toArray());

        echo 'echo $books <br>';
        echo $books;         # echo uses the __toString() MAGIC method - which converts to a string in JSON format

        #Note that $books can be referenced as an array.
        echo 'reference as array, dump title foreach <br>';
        foreach($books as $book) {
            dump($book['title']);
            #OR:
            #dump($book->title);
        }

    }

    /**
    *  Remove any books by the author “J.K. Rowling”.
    */
    public function practice11()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        $result = Book::where('author', '=', 'J.K. Rowling')->delete();
        #dump($result);

        $result = Book::all();
        dump($result->toArray());

    }


    /**
    *  Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
    */
    public function practice10()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        Book::where('author', '=', 'Sylvia Plath')
          ->update(['author' => 'sylvia plath']);


        $result = Book::all();
        dump($result->toArray());

    }


    /**
    * Retrieve all the books in descending order according to published date.
    */
    public function practice9()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        $result = Book::orderBy('published', 'desc')->get();
        dump($result->toArray());

    }

    /**
    * Retrieve all the books published after 1950.
    */
    public function practice8()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        $result = Book::where('published', '>', '1950')->get();
        dump($result->toArray());
        $result = Book::orderBy('created_at', 'desc')->take(2)->get();
    }

    /**
    * Retrieve the last 2 books that were added to the books table.
    */
    public function practice7()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        $result = Book::orderBy('created_at', 'desc')->take(2)->get();
        dump($result->toArray());

    }

    /**
    * Retrieve all the books in alphabetical order by title.
    */
    public function practice6()
    {
        # Get all rows
        #$result = Book::all();
        #dump($result->toArray());

        # Retrieve all the books in alphabetical order by title.
        $result = Book::orderBy('title')->get();
        dump($result->toArray());

    }

    /**
    * Showing Markdown package functionality, alternative:
    */
    /* Alternative to syntax below if the 'use' statement were excluded
    public function practice5()
    {
        $parser = new \cebe\markdown\MarkdownExtra();
        echo $parser->parse('# Hello World');  Will produce <h1>Hello World</h1>
    }
    */
    /**
    * Show how to use some of the Markdown package functionality.
    */
    public function practice5()
    {
        // use markdown extra
        $parser = new MarkdownExtra();
        echo $parser->parse('# Hello World');
    }

    /**
    * Shows how to use some of the Debugbar functionality.
    * If the use statement for the Debugbar was missing then use \Debugbar... here
    */
    public function practice4()
    {
        Debugbar::info($_GET);
        Debugbar::info(['a' => 1, 'b' => 2, 'c' => 3]);
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');
        return 'Practice 4';
    }
    /**
    * Example of what happens accessing a view that does not exist.
    */
    public function practice3()
    {
        return view('abc');
    }
    /**
    * Example of accessing an environment setting.
    */
    public function practice2()
    {
        $email = config('mail');    //or mail.markdown.paths or mail.markdown, etc. you can dig deeper
        dump($email);
    }
    /**
    *  Basic example of a practice method
    */
    public function practice1()
    {
        dump('This is the first example.');
    }
    /**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
    */
    public function index($n = null)
    {
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    # Echo'ing display code from a controller is typically bad; making an
                    # exception here because:
                    # 1. This controller is for debugging/demonstration purposes only
                    # 2. This controller is introduced before we cover views
                    echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
                }
            }
        # Otherwise, load the requested method
        } else {
            $method = 'practice'.$n;
            if (method_exists($this, $method)) {
                return $this->$method();
            } else {
                dd("Practice route [{$n}] not defined");
            }
        }
    }
}
