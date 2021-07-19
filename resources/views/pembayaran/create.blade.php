@extends('layouts.app')

@section('select2')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
                <div class="col-3">
                        <h3><b>Tambah Pembayaran</b></h3>
                        <hr>
                </div>
        </div>
        @if ($errors->any())
                <div class="alert alert-danger">
                        <p>Whoops ! Ada yang salah dengan data yang anda input</p>
                        <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                        </ul>
                </div>
        @endif

        @if ($pesan = Session::get('error'))
            <div class="alert alert-danger text-center">
                <p>{{ $pesan }}</p>
            </div>
        @endif
        

        <form action="">
                <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="harga">Harga SPP :</label>
                                <input type="text" readonly class="form-control" name="harga" id="harga">
                        </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="bulan_terakhir">Bulan Terakhir Bayar :</label>
                                        <input type="text" readonly class="form-control" name="bulan_terakhir" id="bulan_terakhir">
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="tahun_terakhir">Tahun Terakhir Bayar :</label>
                                        <input type="text" readonly class="form-control" name="tahun_terakhir" id="tahun_terakhir">
                                </div>
                        </div>
                </div>
        </form>
        <hr>
        <form action="{{ route('pembayaran.store') }}" method="post">
                @csrf
                @method('POST')

                <div class="row mb-4">                        
                        <div class="col-md-6">
                                <div class="form-group">
                                        <label for="nisn">NISN :</label>
                                        <select name="nisn" id="nisn" required class="form-control" onchange="getDataSpp()">
                                                <option value="" selected>--PILIH SISWA--</option>
                                                @foreach ($siswa as $index=>$data)
                                                    <option value="{{ $data }}">{{ $index }} : {{ $data }}</option>
                                                @endforeach
                                        </select>
                                </div>
                        </div>

                        <div class="col-md-6" hidden>
                                <div class="form-group">
                                        <label for="jumlah_bayar">Jumlah Bayar :</label>
                                        <input type="number"  class="form-control" name="jumlah_bayar" id="jumlah_bayar">
                                </div>
                        </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                <a href="{{ route('pembayarans') }}" class="btn btn-primary btn-sm">Kembali</a>
        </form>
    </div>

    <script>
            $(document).ready(function(){
                $('#nisn').select2();
            });
    </script>

    <script>
            function getDataSpp() {
                var nisn = $('#nisn').val();
                console.log(nisn);

                $.ajax({
                        url: "/pembayaran/dataSpp" + '/' + nisn,
                        type: 'GET',
                        success: function(data) {
                                console.log(data);
                                $('#harga').val('Rp. ' + data['harga']);
                                $('#bulan_terakhir').val(data['bulan_terakhir']);
                                $('#tahun_terakhir').val(data['tahun_terakhir']);
                        }
                })

            }
    </script>
@endsection
