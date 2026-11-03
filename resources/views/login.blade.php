<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>page Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('{{ asset('unpam.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
    </style>
</head>
<body class="bg-light">
    
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center text-primary mb-4">Login Admin</h2>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </form>
            <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">&larr; Kembali ke Home</a>
        </div>
    </div>
</body>
</html>