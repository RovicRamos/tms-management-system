<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#use App\Models\Event; // We can use this later to show upcoming events!

class PageController extends Controller
{
    /**
     * Display the application landing page.
     */
    public function landing()
    {
        // For now, we will just return a blank landing view
        return view('welcome');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}