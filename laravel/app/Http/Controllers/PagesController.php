<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages/index');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function shop()
    {
        return view('pages/shop');
    }

    public function category()
    {
        return view("/pages/shop/category");
    }
    public function cart()
    {
        return view("/pages/shop/cart");
    }
    public function item()
    {
        return view("/pages/shop/details");
    }

    public function contact()
    {
        return view('pages/contact');
    }
    public function houses()
    {
        return view('pages/houses');
    }


}
