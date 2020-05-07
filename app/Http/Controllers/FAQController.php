<?php

namespace App\Http\Controllers;

use App\Faq;

class FAQController extends Controller
{
    public function show() {
        $faqs = Faq::all();
        return view('pages.faq.faq', ['faqs' => $faqs, 'pages' => array('FAQ'), 'links'=>array(url('/faq/'))]);
    }
}