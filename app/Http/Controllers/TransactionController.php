<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sale;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $categories = Category::get();
        $lastTransaction = Sale::orderBy('note_number', 'desc')->first();
        // dd($lastTransaction);

        if ($lastTransaction) {
            $lastNumber = intval($lastTransaction->note_number); // Konversi ke integer
            $newNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT); // Tambah 1 dan tetap 9 digit
        } else {
            $newNumber = '000000001'; // Jika belum ada transaksi
        }


        return view('pages.transactions.index', [
            'title' => 'Transaksi',
            'note_number' => $newNumber
            // 'categories' => $categories
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
