<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sales = Sale::get();

        return view('pages.transactions.index', [
            'title' => 'Transaksi',
            'sales' => $sales
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Simpan Customer
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);


        // Hitung total pembayaran
        $totalAmount = 0;
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $totalAmount += $productData->price * $product['quantity'];
        }

        // Simpan Sale
        $sale = Sale::create([
            'note_number' => $request->note_number,
            'customer_id' => $customer->id,
            'user_id' => Auth::id(),
            'sales_date' => now(),
            'total_amount' => $totalAmount,
            'discount' => 0,
            'down_payment' => 0,
            'remaining_payment' => $totalAmount,
            'payment_status' => '0',
        ]);

        // Simpan Sale Items
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $productData->price,
            ]);
        }

        return redirect()->route('transactions.checkout')->with('success', 'Order berhasil disimpan!');
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

    public function checkout(Request $request)
    {
        // $checkoutData = session('checkout_data', []);

        // if (empty($checkoutData)) {
        //     return redirect()->route('transactions.store')->withErrors(['error' => 'Data tidak ditemukan. Silakan isi form kembali.']);
        // }
        $lastTransaction = Sale::orderBy('note_number', 'desc')->first();
        // dd($lastTransaction);

        if ($lastTransaction) {
            $lastNumber = intval($lastTransaction->note_number); // Konversi ke integer
            $newNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT); // Tambah 1 dan tetap 9 digit
        } else {
            $newNumber = '000000001'; // Jika belum ada transaksi
        }


        $products = Product::get();

        return view('pages.transactions.checkout.index', [
            'title' => 'Checkout',
            'products' => $products,
            'note_number' => $newNumber,
        ]);
    }

    public function checkoutEdit(Request $request, String $id)
    {
        $sale = Sale::find($id);
        $products = Product::get();

        return view('pages.transactions.checkout.checkoutEdit.index', [
            'title' => 'Checkout',
            'products' => $products,
            'sale' => $sale
        ]);
    }

    public function transactionEdit(Request $request, String $id)
    {
        SaleItem::where('sale_id', $id)->delete($id);

        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);


        // Hitung total pembayaran
        $totalAmount = 0;
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $totalAmount += $productData->price * $product['quantity'];
        }

        // Simpan Sale
        $sale = Sale::findOrFail($id); // Gunakan findOrFail agar error muncul jika sale tidak ditemukan
        $sale->update([
            'total_amount' => $totalAmount,
            'down_payment' => 0,
            'remaining_payment' => $totalAmount,
            'payment_status' => '0',
        ]);

        // Simpan Sale Items
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $productData->price,
            ]);
        }

        return redirect()->route('transactions.index')->with('successEditSaleItems', 'Item berhasil disimpan!');
    }
    public function settlement(Request $request, String $id)
    {
        $request->validate([
            'down_payment' => 'required|numeric|min:0',
        ]);
        
        // Ambil nilai pembayaran terbaru dari request
        $newPayment = $request->input('down_payment');
        
        // Ambil data transaksi dari database
        $sale = Sale::findOrFail($id);
        
        // Hitung ulang `remaining_payment` berdasarkan perubahan `down_payment`
        $sale->remaining_payment = max(0, $sale->total_amount - $newPayment);
        $sale->down_payment = $newPayment;
        $sale->payment_status = ($sale->down_payment >= $sale->total_amount) ? 1 : 0;
        
        // Simpan perubahan
        $sale->save();
        return redirect()->route('sale_item.show',['id' => $id])->with('successUpdate','Berhasil update data');
    }
}
