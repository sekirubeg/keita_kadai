<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', ['products' => $products]);
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $item = Product::where('name', 'LIKE',"%{$name}%")->first();
        $param =[
            'item' => $item
        ];
        return view('search', $param);
    }
}
