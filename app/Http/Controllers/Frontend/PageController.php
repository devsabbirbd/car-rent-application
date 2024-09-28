<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.frontend.home');
    }

    public function cars()
    {
        return view('pages.frontend.cars');
    }

    public function rental()
    {
        return view('pages.frontend.rental-history');
    }

    public function profile()
    {
        return view('pages.frontend.profile');
    }

    public function about()
    {
        return view('pages.frontend.inner-page.about');
    }
    public function company()
    {
        return view('pages.frontend.inner-page.company');
    }
    public function services()
    {
        return view('pages.frontend.inner-page.services');
    }
    public function testimonials()
    {
        return view('pages.frontend.inner-page.testimonials');
    }
    public function contact()
    {
        return view('pages.frontend.inner-page.contact');
    }
}

