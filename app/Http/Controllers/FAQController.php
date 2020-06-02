<?php

namespace App\Http\Controllers;

use App\FAQ;

class FAQController extends Controller
{
    public function show() {
        $faqs = FAQ::all();
        return view('pages.faq.faq', ['faqs' => $faqs,'breadcrumbs' => ['FAQ' => url("/faq")]]);
    }
}