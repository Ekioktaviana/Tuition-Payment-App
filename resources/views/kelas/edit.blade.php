@extends('layouts.app')

@section('select2')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
        
        <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        
        <!-- Select2 JS --> 
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
                        <h3><b>Edit Kelas</b></h3>
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
        <form action="{{ route('kela.update', $id->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="row mb-4">
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="nama_kelas">Nama Kelas :</label>
                                        <input value="{{ $id->nama_kelas }}" type="text" name="nama_kelas" id="nama_kelas" required class="form-control">
                                </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="kompetensi_keahlian">Kompetensi Keahlian :</label>
                                        <input value="{{ $id->kompetensi_keahlian }}" type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" required class="form-control">
                                </div>
                        </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                <a href="{{ route('kelas') }}" class="btn btn-primary btn-sm">Kembali</a>
        </form>
    </div>
@endsection