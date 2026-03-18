<!DOCTYPE html>
<html>
<head>
    <title>Sports Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@include('layouts.header')

<div class="max-w-7xl mx-auto p-6">
    @yield('content')
</div>

@include('layouts.footer')

</body>
</html>