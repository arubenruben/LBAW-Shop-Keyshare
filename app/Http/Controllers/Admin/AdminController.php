<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin.pages.homepage');
    }

    public function productShow()
    {

    }

    public function productAdd()
    {

    }

    public function productGet()
    {

    }

    public function productForm()
    {

    }

    public function productUpdateView($id)
    {

    }

    public function productUpdate($id)
    {

    }

    public function productDelete($id)
    {

    }

    public function categoryGet()
    {

    }

    public function categoryShow()
    {

    }

    public function categoryAdd()
    {

    }

    public function categoryUpdate($id)
    {

    }

    public function categoryDelete($id)
    {

    }

    public function genreGet()
    {

    }

    public function genreShow()
    {

    }

    public function genreAdd()
    {

    }

    public function genreUpdate($id)
    {

    }

    public function genreDelete($id)
    {

    }

    public function platformGet()
    {

    }

    public function platformShow()
    {

    }

    public function platformAdd()
    {

    }

    public function platformUpdate($id)
    {

    }

    public function platformDelete($id)
    {

    }

    public function userGet()
    {

    }

    public function userShow()
    {

    }

    public function userUpdate($id)
    {

    }

    public function reportGet()
    {

    }

    public function reportShow()
    {

    }

    public function reportShowMessages($id)
    {

    }

    public function reportMessage($id)
    {

    }

    public function transactionGet()
    {

    }

    public function transactionShow()
    {

    }

    public function feedbackGet()
    {

    }

    public function feedbackShow()
    {

    }

    public function feedbackDelete($id)
    {

    }

    public function faqGet()
    {

    }

    public function faqShow()
    {

    }

    public function faqAdd()
    {

    }

    public function faqUpdate($id)
    {

    }

    public function faqDelete($id)
    {

    }
    public function __construct()
    {
        $this->middleware('auth:admin');

        View::share('nav', 'dashboard');
    }

}