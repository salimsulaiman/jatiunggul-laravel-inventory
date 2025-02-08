<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Input Order</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('transactions.checkout') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">No Nota:</label>
                        <input type="text" name="note_number" class="form-control" required readonly
                            value="{{ $note_number }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon:</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>

                    <div id="products-container">
                        <div class="row product-row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Produk:</label>
                                <select name="products[0][id]" class="form-select select2 form-control" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} -
                                            Rp{{ number_format($product->price, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity:</label>
                                <input type="number" name="products[0][quantity]" class="form-control" min="1"
                                    required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-product">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">

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
