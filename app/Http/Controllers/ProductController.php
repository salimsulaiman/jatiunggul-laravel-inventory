<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::get();
        $categories = Category::get();
        return view('pages.products.index', [
            'title' => 'Product Data',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
        ],[
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal harus 3 huruf',
        ]);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category'),
        ];

        Product::create($data);
        return redirect()->route('products')->with('successAdd','Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, String $id)
    {
        //
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category'),
            'updated_at' => now()
        ];

        Product::where('id', $id)->update($data);
        return redirect()->route('products')->with('successUpdate','Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, String $id)
    {
        //
        Product::where('id', $id)->delete($id);
        return redirect()->route('products')->with('successDelete','Berhasil hapus data');
    }

    public function search(Request $request){
        $search = $request->input('search');
        $products = Product::where('name', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
          $categories = Category::get();

        return view('products', [
            'title' => 'Product Data',
            'products' => $products,
            'categories' => $categories
        ]);
    }
}