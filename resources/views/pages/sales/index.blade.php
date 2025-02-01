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

                                    <button class="btn btn-danger" type="submit">Hapus</button>
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
        <p class="text-success"><strong>Potongan:</strong> @currency(300000)</p>
        <p class="fs-4 fw-bold">Total: @currency($sale->total_amount - 300000)</p>
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
