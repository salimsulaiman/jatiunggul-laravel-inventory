<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Order</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('transaction.put', ['id' => $sale->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <h3 class="fst-normal">No Nota : <span class="fw-bold">{{ $sale->note_number }}</span></h3>
                    </div>
                    <div class="mb-3">
                        <h5 class="fw-bold">{{ $sale->customer->name }}</h5>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">{{ $sale->customer->phone }}</h6>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">{{ $sale->customer->email }}</h6>
                    </div>
                    <div class="mb-5">
                        <h6 class="fst-italic text-body-secondary">{{ $sale->customer->address }}</h6>
                    </div>


                    <div id="products-container">
                        @foreach ($sale->sale_item as $key => $sale_item)
                            <div class="row product-row mb-3">

                                <div class="col-md-6">
                                    <label class="form-label">Produk:</label>
                                    <select name="products[{{ $key }}][id]"
                                        class="form-select select2 form-control" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $sale_item->product_id ? 'selected' : '' }}>
                                                {{ $product->name }} - Rp{{ number_format($product->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantity:</label>
                                    <input type="number" name="products[{{ $key }}][quantity]"
                                        class="form-control" min="1" required
                                        value="{{ $sale_item->quantity }}">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-product">Hapus</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-success" id="add-product">Tambah Produk</button>

                    <button type="submit" class="btn btn-primary">Simpan Order</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let productIndex = 1;

        $(".select2").select2({
            width: '100%',
            placeholder: "Pilih Produk",
            allowClear: true
        });

        document.getElementById("add-product").addEventListener("click", function() {
            let container = document.getElementById("products-container");
            let newRow = document.createElement("div");
            newRow.classList.add("row", "product-row", "mb-3");
            newRow.innerHTML = `
                    <div class="col-md-6">
                        <label class="form-label">Produk:</label>
                        <select name="products[${productIndex}][id]" class="form-select select2" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - Rp{{ number_format($product->price, 2) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantity:</label>
                        <input type="number" name="products[${productIndex}][quantity]" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-product">Hapus</button>
                    </div>
                `;
            container.appendChild(newRow);

            $(".select2").select2({
                width: '100%',
                placeholder: "Pilih Produk",
                allowClear: true
            });

            productIndex++;
        });

        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("remove-product")) {
                event.target.closest(".product-row").remove();
            }
        });
    });
</script>
