<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // If Controller has multiple jobs, may have multiple functions:
    /*
    public function index() {
        return view('welcome');
    }
    */

    /* ALTERNATIVE: Because this controller only has one job, can use: */
    public function __invoke() {
        return view('welcome');
    }

}
