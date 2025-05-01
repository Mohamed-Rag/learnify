<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // You may want to use this controller for other pages
    // but remove the registration/login methods to avoid conflicts
    // with the Auth controllers provided by Laravel

    // Example of other page methods you might use:
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
?>
