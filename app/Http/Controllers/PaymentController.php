<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        $request->validate([
            'sale_id' => 'required',
            'down_payment' => 'required|min:4|numeric',
            'payment_date' => 'required',
            'payment_method' => 'required',
        ], [
            'down_payment.required' => 'Nominal harus diisi',
            'down_payment.min' => 'Nominal minimal harus 4 digit',
            'down_payment.numeric' => 'Nominal harus berupa angka',
            'payment_date.required' => 'Tanggal harus diisi',
            'payment_method.required' => 'Jenis pembayaran harus diisi',
        ]);

        $sale_id = $request->input('sale_id');
        $down_payment = $request->input('down_payment');
        $sale = Sale::find($sale_id);

        if (!$sale) {
            return redirect()->back()->withErrors(['sale_id' => 'Data penjualan tidak ditemukan.']);
        }

        // Hitung sisa pembayaran yang diperbolehkan
        $remaining_amount = $sale->total_amount - $sale->down_payment - $sale->discount;

        if ($down_payment > $remaining_amount) {
            return redirect()->back()->withErrors(['down_payment' => 'Nominal down payment melebihi batas yang diperbolehkan. Sisa pembayaran: Rp.' . number_format($remaining_amount)]);
        }

        $data = [
            'sale_id' => $sale_id,
            'amount_paid' => $down_payment,
            'payment_date' => $request->input('payment_date'),
            'payment_method' => $request->input('payment_method'),
        ];

        $dataSale = [
            'down_payment' => $sale->down_payment + $down_payment,
            'payment_status' => (($sale->down_payment + $down_payment) >= ($sale->total_amount - $sale->discount)) ? 'paid' : 'pending'
        ];

        Payment::create($data);
        Sale::where('id', $sale_id)->update($dataSale);

        return redirect()->route('sale_item.show', ['id' => $sale_id])
            ->with('successAdd', 'Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
