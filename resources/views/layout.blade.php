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
  <div class=" w-full h-screen flex  border outline-4 pr-10">
    <!-- Sidebar -->
    <div class="h-1/3">
      @include('partials.SideBar')
    </div>
  
    <div class="w-full top-0 border outline-4">
        <!-- Navbar -->
        @include('partials.NavBar')
  
        <!-- Content Area -->
        <div class=" mx-4 my-8">
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
