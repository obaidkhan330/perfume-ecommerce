{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Custom Styles --}}
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
        .logo {
            font-weight: bold;
            font-size: 1.2rem;
            color: #343a40;
        }
        .admin-name {
            font-weight: 500;
            color: #343a40;
        }
    </style>

</head>
@yield('content')
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <div class="sidebar p-3">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{route('admin.products.index')}}">Products</a>
        <a href="">Categories</a>
        <a href="">Orders</a>
        <a href="">Users</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    {{-- Main Content --}}
    <div class="flex-grow-1">
        {{-- Topbar --}}
        <div class="topbar d-flex justify-content-between align-items-center p-3">
           <img src="naxham/assets/images/logo.png" alt="logo" class="navbar-logo  ">
            <div class="admin-name">
                Welcome,@auth
                     {{ Auth::User()->name ?? 'Admin' }}
                @endauth
                @guest
                GUEST

                @endguest
            </div>
        </div>

        {{-- Page Content --}}
        <div class="container mt-4">
            <h2>Dashboard</h2>
            <p>This is your admin control center. Use the sidebar to manage products, categories, orders, and users.</p>
        </div>
    </div>
</div>
</body>
</html>
