<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

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
        $sort = $request->input('sort');
        $query = Product::query();

        if ($name) {
        $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($sort === 'price_desc') {
        $query->orderBy('price', 'desc');
        } elseif ($sort === 'price_asc') {
        $query->orderBy('price', 'asc');
        }
        $items = $query->paginate(6);

        $param =[
            'items' => $items,
            'name' => $name,
            'sort' => $sort,
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
    public function update(ProductRequest $request)
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
    public function register()
    {
        $allSeasons = Season::all(); // 全ての季節を取得
        return view('add',  compact('allSeasons'));
    }
    public function store(ProductRequest $request)
    {
        $product = new Product();

        if($request->hasFile('image')){
            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('fruits-img', $originalName, 'public');
            $product->image = $path;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->text = $request->text;

        $product->save();
        $product->seasons()->sync($request->seasons);
        return redirect('/products');
    }
}
