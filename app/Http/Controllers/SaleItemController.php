<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Temukan SaleItem yang akan dihapus
        $saleItem = SaleItem::findOrFail($id);
        $sale_id = $saleItem->sale_id;

        // Hapus SaleItem terlebih dahulu
        $saleItem->delete();

        // Hitung ulang total_amount setelah penghapusan
        $totalAmount = SaleItem::where('sale_id', $sale_id)
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->sum(DB::raw('sale_items.quantity * products.price'));

        // Perbarui data Sale
        $sale = Sale::findOrFail($sale_id);
        $sale->update([
            'total_amount' => $totalAmount,
            'remaining_payment' => $totalAmount - $sale->down_payment,
            'payment_status' => $totalAmount == 0 ? '0' : $sale->payment_status,
        ]);
        return redirect("saleitems/$sale_id")->with('successDelete', 'Berhasil menghapus data');
    }
}
