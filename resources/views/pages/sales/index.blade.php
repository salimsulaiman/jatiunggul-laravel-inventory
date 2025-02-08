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

                                    <button class="btn btn-link" type="submit"><i class="fa-solid fa-xmark"></i></button>
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
        <p class="fw-bold text-danger mt-3">Kekurangan: @currency($sale->remaining_payment)</p>
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#settlement">Pelunasan</button>
        <div class="modal fade" id="settlement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pelunasan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('transactions.settlement', ['id' => $sale->id]) }}">
                        @csrf
                        @method('put')
                        <div class="modal-body px-4 text-start">
                            <h5 class="fw-bold mb-2">No Nota: {{$sale->note_number}}</h5>
                            <p class="mb-2 fw-bold">{{ $customer->name }}</p>
                            <p class="mb-2">{{ $customer->phone }}</p>
                            <p>{{ $customer->address }}</p>
                            <h4 class="fw-bold">Total: @currency($sale->total_amount - $sale->discount)</h4>
                            
                            <!-- Edit Down Payment -->
                            <div class="mb-3">
                                <label for="down_payment" class="form-label">Total Down Payment</label>
                                <input type="number" id="down_payment" name="down_payment" class="form-control"
                                    placeholder="Masukkan down payment baru" value="{{ $sale->down_payment }}" min="0">
                            </div>
                    
                            <!-- Sisa Pembayaran -->
                            <div class="mb-3">
                                <label for="remaining_payment" class="form-label">Sisa Pembayaran</label>
                                <input type="text" id="remaining_payment" name="remaining_payment" class="form-control"
                                    value="@currency($sale->remaining_payment)" readonly>
                            </div>
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
    @if (session('successDelete'))
        <div class="toast toast-end" id="toast">
            <div class="alert bg-red-600 text-white">
                <span>{{ session('successDelete') }}</span>
            </div>
        </div>
    @endif
    @if (session('successAdd'))
        <div class="toast toast-end" id="toast">
            <div class="alert bg-green-600 text-white">
                <span>{{ session('successAdd') }}.</span>
            </div>
        </div>
    @endif
    @if (session('successUpdate'))
        <div class="toast toast-end" id="toast">
            <div class="alert bg-green-600 text-white">
                <span>{{ session('successUpdate') }}.</span>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="toast toast-end" id="toast">
            <div class="alert bg-red-600 text-white">
                <span>
                    @foreach ($errors->all() as $error)
                        {{ $error }},
                    @endforeach
                </span>
            </div>
        </div>
    @endif
    </div>
</x-layout>
