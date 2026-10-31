@extends('layouts.app')

@section('title', 'Halaman Home')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h1 class="text-center mb-4">Dashboard</h1>
            <p>Selamat di halaman home</p>
            <a href="{{ url('/profile') }}" class="btn btn-success d-inline-block w-auto">Lihat halaman profil</a>
        </div>
    </div>
@endsection