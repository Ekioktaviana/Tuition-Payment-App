@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text text-center">

                        Selamat Datang Di Aplikasi Pembayaran SPP
                        <br>
                        SMK WIKRAMA 1 GARUT
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
