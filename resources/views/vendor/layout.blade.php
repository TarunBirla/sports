<!DOCTYPE html>
<html>
<head>
    <title>Vendor Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

<!-- SIDEBAR -->
<div class="w-64 bg-black text-white min-h-screen p-4">

    <h2 class="text-xl font-bold mb-6">Vendor Panel</h2>

   <ul class="space-y-3">
    <li><a href="/vendor/dashboard">Dashboard</a></li>

    @if(session('vendor_type') == 'training')
        <li><a href="/vendor/training">Trainings</a></li>
    @endif

    @if(session('vendor_type') == 'course')
        <li><a href="/vendor/course">Courses</a></li>
    @endif

    <li><a href="/vendor/logout">Logout</a></li>
</ul>

</div>

<!-- MAIN CONTENT -->
<div class="flex-1">

    <!-- NAVBAR -->
    <div class="bg-white shadow p-4 flex justify-between">
        <h2 class="font-bold">Vendor Dashboard</h2>
        <span>Welcome Vendor</span>
    </div>

    <!-- PAGE CONTENT -->
    <div class="p-6">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <div class="bg-gray-800 text-white text-center p-3">
        © Vendor Panel 2026
    </div>

</div>

</body>
</html>