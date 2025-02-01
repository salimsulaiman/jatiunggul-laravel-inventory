<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::get();
        return view('pages.categories.index', [
            'title' => 'Category Data',
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
        ];

        Category::create($data);
        return redirect()->route('categories')->with('successAdd','Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, String $id)
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
        ];

        Category::where('id', $id)->update($data);
        return redirect()->route('categories')->with('successUpdate','Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, String $id)
    {
        //
        Category::where('id', $id)->delete($id);
        return redirect()->route('categories')->with('successDelete','Berhasil hapus data');
    }
}