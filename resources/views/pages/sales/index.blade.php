<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="d-flex align-items-center my-4">
        <a href="/customer/{{ $customer->id }}" class="fs-4 text-secondary text-decoration-none">&laquo; Kembali</a>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <h1 class="fw-bold display-4">Invoice</h1>
    </div>

    <div class="row my-4">
        <div class="col-md-6">
            <h4 class="fw-bold">INVOICE UNTUK:</h4>
            <p class="mb-1 fw-bold">{{ $customer->name }}</p>
            <p class="mb-1">{{ $customer->phone }}</p>
            <p>{{ $customer->address }}</p>
        </div>
        <div class="col-md-6 text-end">
            <h4 class="fw-bold">No Nota: <span class="fw-normal">{{ $sale->note_number }}</span></h4>
            <p>{{ $sale->sales_date->format('d M Y') }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleItems as $index => $saleItem)
                    {{-- {{ dd($saleItems) }} --}}
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $saleItem->product->name }}</td>
                        <td>{{ $saleItem->product->category->name }}</td>
                        <td>{{ $saleItem->quantity }}</td>
                        <td>@currency($saleItem->price)</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('sale_item.destroy', ['id' => $saleItem->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" value="{{ $saleItem->id }}">

                                    <button class="btn btn-link" type="submit"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-end mt-4">
        <p><strong>Subtotal:</strong> @currency($sale->total_amount)</p>
        <p class="text-success"><strong>Potongan:</strong> @currency($sale->discount)</p>
        <h2 class="fw-bold">Total: @currency($sale->total_amount - $sale->discount)</h2>
        <p class="fw-bold text-danger mt-3">Kekurangan: @currency($sale->total_amount - $sale->discount - $sale->down_payment)</p>
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal"
            data-bs-target="#settlement">Pelunasan</button>
        <div class="modal fade" id="settlement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pelunasan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('payment.post') }}">
                        @csrf
                        <div class="modal-body px-4 text-start">
                            <h5 class="fw-bold mb-2">No Nota: {{ $sale->note_number }}</h5>
                            <p class="mb-2 fw-bold">{{ $customer->name }}</p>
                            <p class="mb-2">{{ $customer->phone }}</p>
                            <p>{{ $customer->address }}</p>
                            <h4 class="fw-bold mb-2">Total: @currency($sale->total_amount - $sale->discount)</h4>
                            <h6 class="fw-bold mb-2 text-danger">Kekurangan: @currency($sale->total_amount - $sale->discount - $sale->down_payment)</h6>

                            <!-- Edit Down Payment -->
                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <div class="mb-3">
                                <label for="down_payment" class="form-label">Pembayaran</label>
                                <input type="number" id="down_payment" name="down_payment" class="form-control"
                                    placeholder="Masukkan nominal" min="0" required>
                            </div>

                            <!-- Sisa Pembayaran -->
                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Tanggal Bayar</label>
                                <input type="date" id="payment_date" name="payment_date" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <input type="text" id="payment_method" name="payment_method" class="form-control"
                                    placeholder="Jenis pembayaran" required>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Bayar</th>
                                        <th scope="col">Tanggal bayar</th>
                                        <th scope="col">Metode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale->payment as $index => $payment)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>@currency($payment->amount_paid)</td>
                                            <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                            <td>{{ $payment->payment_method }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="fw-bold">INFORMASI PEMBAYARAN</h4>
        <p class="mb-1 fw-bold">PT Jati Unggul Perkasa</p>
        <p class="mb-1">CS: {{ $sale->user->name }}</p>
        <p>{{ $sale->created_at->format('d M Y | H:i A') }}</p>
    </div>
    @if (session('successAdd'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successAdd') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    </div>
</x-layout>
