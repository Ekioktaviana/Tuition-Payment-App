@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <meta http-equiv="refresh" content="15"> --}}

@endsection

@section('datatables')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-3">
                    <h3><b>Pembayaran</b></h3>
                    <hr>
            </div>
        </div>
        @if ($pesan = Session::get('sukses'))
            <div class="alert alert-success text-center">
                <p>{{ $pesan }}</p>
            </div>
        @endif
        
        <div class="row mb-4">
            <div class="col-6">
                <div class="row">
                    {{-- <div class="col-2">
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-primary">Pembayaran 1 Bulan</a>
                    </div>           
                    <div class="col-3">
                        &nbsp;   --}}
                        <a href="{{ route('pembayaran.create2') }}" class="btn btn-sm btn-primary">Pembayaran</a>
                    {{-- </div> --}}
                </div>
            </div>
                       
            <div class="col-6 text-right">
                <a href="{{ route('pembayaran.export') }}" class="btn btn-success btn-sm">Excel</a>    
            </div> 
        </div>
        <table id="table" class="table table-sm mt-4">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Petugas</th>
                    <th>Kelas</th>
                    {{-- <th>Kompetensi Keahlian</th> --}}
                    <th>SPP</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan Dibayar</th>
                    <th>Tahun Dibayar</th>
                    {{-- <th>Jumlah Bayar</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        {{-- <td>{{ $data->kompetensi_keahlian }}</td> --}}
                        <td>{{ $data->tahun }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->bulan_dibayar }}</td>
                        <td>{{ $data->tahun_dibayar }}</td>
                        {{-- <td>{{ number_format($data->jumlah_bayar,2,',','.') }}</td> --}}
                        <td>
                            <form action="{{ route('pembayaran.destroy',$data->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('pembayaran.show', $data->id) }}" target="_blank" class="btn btn-info btn-sm">Detail</a>
                                {{-- <button type="submit" class="btn btn-sm btn-danger">Hapus</button> --}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $('#table').dataTable();
    </script>
@endsection