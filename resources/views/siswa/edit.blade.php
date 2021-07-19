@extends('layouts.app')

@section('select2')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
        
        <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        
        <!-- Select2 JS --> 
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection
{{-- 
@section('datatables')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection --}}

@section('content')
    <div class="container">
        <div class="row mb-2">
                <div class="col-3">
                        <h3><b>Edit Siswa</b></h3>
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
        <form action="{{ route('siswa.update',$nisn->nisn) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="row mb-4">
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="nisn">NISN :</label>
                                        <input value="{{ $nisn->nisn }}" type="number" name="nisn" id="nisn" required min="1" class="form-control">
                                </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="nis">NIS :</label>
                                        <input value="{{ $nisn->nis }}" type="number" name="nis" id="nis" required min="1"  class="form-control">
                                </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="nama_siswa">Nama Siswa :</label>
                                        <input value="{{ $nisn->nama_siswa }}" type="text" name="nama_siswa" id="nama_siswa" required  class="form-control">
                                </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="id_kelas">Kelas :</label>
                                        {{-- <input type="number" name="id_kelas" id="id_kelas" required min="1"  class="form-control"> --}}
                                        <select name="id_kelas" id="id_kelas" required class="form-control">
                                                <option value="">--PILIH KELAS--</option>
                                                @foreach ($kelas as $index=>$data)
                                                    <option value="{{ $index }}" @if ($index == $nisn->id_kelas)
                                                            selected
                                                    @endif>{{ $data }}</option>
                                                @endforeach
                                        </select>
                                </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="id_spp">SPP :</label>
                                        {{-- <input type="number" name="id_spp" id="id_spp" required min="1"  class="form-control"> --}}
                                        <select name="id_spp" id="id_spp" required class="form-control">
                                                <option value="">--PILIH SPP--</option>
                                                @foreach ($spp as $index=>$data)
                                                    <option value="{{ $index }}" @if ($index == $nisn->id_spp)
                                                            selected
                                                    @endif>{{ $data }}</option>
                                                @endforeach
                                        </select>
                                </div>
                        </div>
                        
                        
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="no_telepon">No Telepon :</label>
                                        <input value="{{ $nisn->no_telepon }}" type="number" name="no_telepon" id="no_telepon" required min="1"  class="form-control">
                                </div>
                        </div>
                        
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="alamat">Alamat :</label>
                                        <textarea type="text" name="alamat" id="alamat" required min="1"  class="form-control">{{ $nisn->alamat }}</textarea>
                                </div>
                        </div>
                        
                </div>

                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                <a href="{{ route('siswas') }}" class="btn btn-primary btn-sm">Kembali</a>
        </form>
    </div>

    <script>
            $(document).ready(function(){
                $('#id_kelas').select2();
                $('#id_spp').select2();
            });
    </script>
@endsection