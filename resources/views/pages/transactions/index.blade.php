<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="/transactions/checkout" class="btn btn-success mb-4">Tambah
        Transaksi +</a>
    @if (session('successEditSaleItems'))
        <div class="alert alert-success">
            {{ session('successEditSaleItems') }}
        </div>
    @endif
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Nota</th>
                <th>Pembeli</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $index => $sale)
                <tr>
                    <th>{{ $index + 1 }}</th>
                    <td>{{ $sale->note_number }}</td>
                    <td>{{ $sale->customer->name }}</td>
                    <td>{{ $sale->created_at->format('d M Y | H:i A') }}</td>
                    <td>{{ $sale->updated_at->format('d M Y | H:i A') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/transactions/checkoutEdit/{{ $sale->id }}" class="btn btn-success">Edit</a>
                            <a href="/saleitems/{{ $sale->id }}" class="btn btn-warning">Detail</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</x-layout>
