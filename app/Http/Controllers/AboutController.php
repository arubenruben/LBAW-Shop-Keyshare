<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        return view('pages.static.about', ['breadcrumbs' => ['About Us' => url("/about")]]);
    }
}
