<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ref\Produk as Category;
use App\Models\Mst\Produk as Produk; 

class FrontendController extends Controller
{
    public function index(){
    	$category = Category::all();
    	$featured_category = Category::where('featured', 1)->limit(3)->get();
    	$featured_produk = Produk::where('featured', 1)->limit(4)->get();
    	// var_dump($featured); die();
    	return view('layouts.shop', compact('category', 'featured_produk', 'featured_category'));
    }
}
