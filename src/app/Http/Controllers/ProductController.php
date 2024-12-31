<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Season;
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
    public function detail($id)
    {
        $product = Product::with('seasons')->findOrFail($id); // 商品とその関連する季節を取得
        $allSeasons = Season::all(); // 全ての季節を取得
        return view('detail', compact('product', 'allSeasons'));
    }
    public function delete(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('/products');
    }
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($request->hasFile('image')) {
        $originalName = $request->file('image')->getClientOriginalName();
        // 新しい画像を保存
        $path = $request->file('image')->storeAs('fruits-img', $originalName, 'public');
        $product->image = $path; // データベースに保存するのは相対パス
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->text = $request->text;
        $product->seasons()->sync($request->seasons);
        $product->save();

    return redirect('/products');
    }
}
