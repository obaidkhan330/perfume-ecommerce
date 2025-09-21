{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar p-3">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{route('admin.products.index')}}">Products</a>
            <a href="{{ route('admin.variations.index') }}">Variations</a>
            <a href="{{ route('admin.orders') }}">Orders</a>
            <a href="{{ route('admin.testers.index') }}">Testers</a>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="adminNotifDropdown" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell fs-5"></i> <!-- Bootstrap bell icon -->
        <span id="admin-notif-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            0
            <span class="visually-hidden">unread notifications</span>
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow" id="admin-notif-list" aria-labelledby="adminNotifDropdown" style="min-width: 250px;">
        <li class="text-center py-2"><span class="text-muted">Loading...</span></li>
    </ul>
</li>


            <a href="">Users</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1">
            {{-- Topbar --}}
            <div class="topbar d-flex justify-content-between align-items-center p-3">
                <img src="{{ asset('naxham/assets/images/logo.png') }}" alt="logo" style="max-height:60px;" class="navbar-logo">
                <div class="admin-name">
                    Welcome,@auth
                    {{ Auth::User()->name ?? 'Admin' }}
                    @endauth
                    @guest
                    GUEST

                    @endguest
                </div>
            </div>



            @yield('content')


        </div>
    </div>
    <!-- Bootstrap JS (with Popper) -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function loadAdminNotifications() {
    $.ajax({
        url: "{{ route('admin.notifications.fetch') }}",
        method: 'GET',
        success: function (data) {
            let notifications = data.notifications;
            let list = $("#admin-notif-list");
            let count = $("#admin-notif-count");

            list.empty();

            if (notifications.length > 0) {
                count.text(notifications.length);

                notifications.forEach(function (notif) {
                    list.append(`
                        <li class="d-flex justify-content-between align-items-center px-2">
                            <a class="dropdown-item" href="#">
                                ${notif.data.message}
                            </a>
                            <button class="btn btn-sm btn-link text-danger" onclick="deleteAdminNotif('${notif.id}')">
                                ❌
                            </button>
                        </li>
                    `);
                });

            } else {
                count.text(0);
                list.append('<li><span class="dropdown-item">No new notifications</span></li>');
            }
        },
        error: function(err) {
            console.log("Notification fetch error:", err);
        }
    });
}

function deleteAdminNotif(id) {
    $.ajax({
        url: "/admin/notifications/delete/" + id,
        method: 'DELETE',
        data: {_token: "{{ csrf_token() }}"},
        success: function () {
            loadAdminNotifications();
        },
        error: function(err) {
            console.log("Notification delete error:", err);
        }
    });
}

// Page load pe call
$(document).ready(function(){
    loadAdminNotifications();
    setInterval(loadAdminNotifications, 10000); // Har 10s refresh
});
</script>

</body>



</html>
