<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div>
        <div class="w-100 d-flex align-items-end gap-4 my-5">
            <img src="{{ asset('./images/profile/avatar.png') }}" alt="" class="w-25">
            <div class="">
                <h3 class="fw-bold">{{ $customer->name }}</h3>
                <div class="d-flex gap-2 align-items-center mb-2">
                    <i class="fa fa-phone"></i>
                    <h6 class="mb-0">{{ $customer->phone }}</h6>
                </div>
                <div class="d-flex gap-2 align-items-center mb-2">
                    <i class="fa fa-envelope"></i>
                    <h6 class="mb-0">{{ $customer->email == '' ? '-' : $customer->email }}</h6>
                </div>
                <div class="d-flex gap-2 align-items-center mb-2">
                    <i class="fa fa-map-marker"></i>
                    <h6 class="mb-0">{{ $customer->address }}</h6>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No nota</th>
                    <th>Tanggal beli</th>
                    <th>Total harga</th>
                    <th>Terbayarkan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->sales as $index => $sale)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $sale->note_number }}</td>
                        <td>{{ $sale->sales_date }}</td>
                        <td class="w-32 truncate">@currency($sale->total_amount)</td>
                        <td class="w-32 truncate">@currency($sale->down_payment)</td>
                        <td class="w-32 truncate">
                            <div
                                class="badge {{ $sale->payment_status == 'pending' ? 'text-bg-warning' : 'text-bg-success' }}">
                                {{ $sale->payment_status }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#updateProduct{{ $customer->id }}">Edit</button>
                                <div class="modal fade" id="updateProduct{{ $customer->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Edit Pelanggan
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('customer.put', ['id' => $customer->id]) }}">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body px-4">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="text" id="name" name="name"
                                                            value="{{ $customer->name }}" class="form-control"
                                                            placeholder="Nama pelanggan">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="notelp" class="form-label">No Telp</label>
                                                        <input type="tel" id="notelp" name="notelp"
                                                            value="{{ $customer->phone }}" class="form-control"
                                                            placeholder="Nomor Telepon">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ $customer->email }}" class="form-control"
                                                            placeholder="Email pelanggan">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Alamat</label>
                                                        <textarea id="address" name="address" class="form-control" rows="4" placeholder="Alamat pelanggan">{{ $customer->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="/saleitems/{{ $sale->id }}" class="btn btn-warning">Detail</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>No nota</th>
                    <th>Tanggal beli</th>
                    <th>Total harga</th>
                    <th>Terbayarkan</th>
                    <th>Status</th>
                    <th>Action</th>
            </tfoot>
        </table>
    </div>
    @if (session('successDelete'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successDelete') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

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

    @if (session('successUpdate'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successUpdate') }}
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
</x-layout>
