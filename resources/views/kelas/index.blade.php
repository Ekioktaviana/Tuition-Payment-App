@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta http-equiv="refresh" content="15">

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
                    <h3><b>Kelas</b></h3>
                    <hr>
            </div>
        </div>

        @if ($pesan = Session::get('sukses'))
            <div class="alert alert-success text-center">
                <p>{{ $pesan }}</p>
            </div>
        @endif

        <a href="{{ route('kela.create') }}" class="btn btn-primary mb-4 btn-sm">Tambah Kelas</a>
        <table id="table" class="table table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->kompetensi_keahlian }}</td>
                        <td>
                            <form action="{{ route('kela.destroy',$data->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('kela.edit',$data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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