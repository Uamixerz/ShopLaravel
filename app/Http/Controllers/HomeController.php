<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeProductLabels;
use App\Models\LabelProduct;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $labels = HomeProductLabels::all();
        return view('home', compact('categories','products', 'labels'));
    }
}
