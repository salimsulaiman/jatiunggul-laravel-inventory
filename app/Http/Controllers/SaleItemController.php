<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

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
    public function show(SaleItem $saleItem, String $id)
    {
        $saleItems = SaleItem::where('sale_id', $id)->get();
        $sale = Sale::find($id);
        // dd($sale);
        $customer = $sale->customer;
        // dd($customer->name);

        return view('pages.sales.index', [
            'title' => 'Sales Data',
            'sale' => $sale,
            'customer' => $customer,
            'saleItems' => $saleItems,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItem $saleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $saleItem = SaleItem::find($id);
        $sale_id = $saleItem->sale_id;
        SaleItem::where('id', $id)->delete($id);
        return redirect("saleitems/$sale_id")->with('successDelete', 'Berhasil menghapus data');
    }
}
