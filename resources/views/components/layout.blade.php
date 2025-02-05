<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}" />
    {{-- <link rel="stylesheet" href="./libs/datatables/css/dataTables.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('libs/datatables/css/buttons.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/datatables/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/datatables/css/dataTables.bootstrap5.css') }}">
    <link href="{{ asset('libs/fontawasome/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/fontawasome/css/brands.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/fontawasome/css/solid.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/fontawasome/css/sharp-thin.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/fontawasome/css/duotone-thin.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/fontawasome/css/sharp-duotone-thin.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" />
    <style>
        .dt-buttons .dt-button {
            background-color: #855cf6 !important;
            /* Hijau */
            color: white !important;
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-weight: 500 !important;
            transition: 0.3s !important;
            border: none !important;
            box-shadow: none !important
        }

        .dt-buttons .dt-button:hover {
            background-color: #753aed !important;
        }
    </style>
</head>

<body>
    @if (!request()->is('login') && !request()->is('register'))
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            {{-- sidebar start --}}
            <x-sidebar></x-sidebar>
            {{-- sidebar end --}}
            <!--  Main wrapper -->
            <div class="body-wrapper">
                {{-- header start --}}
                <x-header></x-header>
                {{-- header end --}}
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                            <div class="container-fluid">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{ $slot }}
    @endif
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/dataTables.js') }}"></script>
    {{-- <script src="{{ asset('libs/datatables/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('libs/datatables/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/vsf_fonts.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons.print.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#example', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    },
                },
                scrollX: true,
                pagingType: "simple_numbers", // Menampilkan nomor yang lebih rapat
                lengthMenu: [10, 25, 50, 100], // Mengatur jumlah data per halaman
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
            new DataTable('#productCheckout', {
                scrollX: true,
                pagingType: "simple_numbers", // Menampilkan nomor yang lebih rapat
                lengthMenu: [10, 25, 50, 100], // Mengatur jumlah data per halaman
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
        });
    </script>
    </script>
    {{-- <script src="https://kit.fontawesome.com/72387f0abd.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
