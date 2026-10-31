@extends('admin.template')
@section('title','Halaman Home')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h5>Selamat datang di halaman home</h5>
                <p>Ini halaman admin untuk kelola data project</p>
                <a href="{{ url('/') }}" class="btn btn-success d-inline-block w-auto">Kembali halaman dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection