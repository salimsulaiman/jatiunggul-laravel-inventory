<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col-sm-6">
            <form action="">
                <div class="mb-3">
                    <label for="note_number" class="form-label">No Nota</label>
                    <input type="text" class="form-control" id="note_number" value="{{ $note_number }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pembeli</label>
                    <input class="form-control" id="name" />
                </div>
            </form>
        </div>
    </div>
</x-layout>
