<?php

namespace App\Http\Controllers;

use App\Faq;

class FAQController extends Controller
{
    public function show() {
        $faqs = Faq::all();
        return view('pages.faq.faq', ['faqs' => $faqs,'breadcrumbs' => ['Faq' => url("/faq")]]);
    }
}