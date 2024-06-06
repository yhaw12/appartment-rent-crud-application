<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
  <title>@yield('tittle', 'my ......')</title>

</head>
<body>
  <div class="flex h-screen border outline-4">
    <!-- Sidebar -->
    <div class="flex flex-col h-full overflow-y-auto border-r outline-4">
      @include('partials.SideBar')
    </div>

    <div class="flex flex-col w-full">
        <!-- Navbar -->
        @include('partials.NavBar')

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4">
          @yield('content')
        </div>
    </div>
  </div>
  <style>
    /* Customize the position and styles of alerts */
    #swal2-container {
      z-index: 9999 !important;
    }
  </style>
  
  {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.js"></script> --}}
</body>
</html>
