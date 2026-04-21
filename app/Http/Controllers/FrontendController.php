<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function newsletter()
    {
        $newsletterExists = file_exists(public_path('uploads/newsletter/newsletter.pdf'));
        return view('frontend.newsletter', compact('newsletterExists'));
    }
}
