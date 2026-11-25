<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ session('api_token', '') }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables & Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('DataTables/toastr.min.css') }}">

    <script>
        const API_TOKEN = "{{ session('api_token', '') }}";
        console.log('API TOKEN:', API_TOKEN);
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 20px 0;
            background-color: #212529;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .admin-sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .admin-sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
            margin: 2px 12px;
            border-radius: 6px;
            font-weight: 500;
            display: block;
            text-decoration: none;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }

        .admin-content {
            margin-left: 250px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="admin-sidebar shadow">
        <div>
            <h4 class="text-center fw-bold text-white pb-3 border-bottom border-secondary">Admin Panel</h4>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
                </li>
            </ul>
        </div>
        <div class="p-3 border-top border-secondary">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 btn-sm">Logout</button>
            </form>
        </div>
    </div>

    <main class="admin-content">
        @yield('content')
    </main>

    <!-- jQuery, Bootstrap 5 JS, DataTables & Toastr JS -->
    <script src="{{ asset('DataTables/jquery-3.6.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/toastr.min.js') }}"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000
        };

        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if(session('error'))
            toastr.error(@json(session('error')));
        @endif
    </script>

    @stack('scripts')
</body>

</html>