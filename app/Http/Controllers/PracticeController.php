<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;

class PracticeController extends Controller
{
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
        $email = config('mail');
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
