<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    @yield('js')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    @yield('select2')
        <!-- Select2 CSS --> 
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />  --}}
        
        {{-- <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
        
        <!-- Select2 JS --> 
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}

    @yield('datatables')
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> --}}
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
        <div class="card" id="print" onclick="print()">
            <div class="card-header" style="background-color: rgb(236, 236, 236)">
                <h3 class="text text-center"><b> KWITANSI PEMBAYARAN SPP</b></h3>
                <h4 class="text text-center"><b> SMK WIKRAMA 1 GARUT </b></h4>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <p class="text-right">No. {{ $id->id }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <strong for="">NIS : </strong>
                        <strong for="">{{ $id->nis }}</strong>
                        <br>
                        
                        <strong for="">NAMA : </strong>
                        <strong for="">{{ $id->nama_siswa }}</strong>
                        <br>
                        
                        <strong for="">KELAS : </strong>
                        <strong for="">{{ $id->nama_kelas }}</strong>
                        <br>
                        <strong for="">KOMPETENSI KEAHLIAN : </strong>
                        <strong for="">{{ $id->kompetensi_keahlian }}</strong>
                    </div>

                    <div class="col-6">
                        {{-- <br> --}}

                        <strong for="">ALAMAT : </strong>
                        <strong for="">{{ $id->alamat }}</strong>
                        <br>

                        <strong for="">NOMOR TELEPON : </strong>
                        <strong for="">{{ $id->no_telepon }}</strong>
                        <br>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <strong>NAMA PETUGAS :</strong>
                        <strong>{{ $id->name }}</strong>
                        <br>
                        <strong for="">BULAN DIBAYAR : </strong>
                        <strong for="">{{ $id->bulan_dibayar }}</strong>
                        <br>

                        <strong for="">TAHUN DIBAYAR : </strong>
                        <strong for="">{{ $id->tahun_dibayar }}</strong>
                        <br>

                    </div>
                    <div class="col-6">
                        <strong for="">JUMLAH BAYAR : </strong>
                        <strong for="">Rp. {{ number_format($id->jumlah_bayar,2,',','.') }}</strong>
                        <br>
                        <strong>TANGGAL BAYAR : </strong>
                        <strong>{{ $id->tanggal_bayar }}</strong>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#print').function print() {
            window.print();
        }
    </script>
</body>