<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <title>@yield('title', 'my ......')</title>
</head>
<body>
  <div class="w-full h-screen flex flex-col  overflow-hidden ">
    <div class="flex overflow-hidden">
      <!-- Sidebar -->
      <div class=" overflow-y-auto">
        @include('partials.SideBar')
      </div>
      <div class="flex-1 flex flex-col overflow-hidden">
          <!-- Navbar -->
          @include('partials.NavBar')
          <!-- Content Area -->
          <div class="flex-1 overflow-x-hidden overflow-y-auto p-4">
            @yield('content')
          </div>
      </div>
    </div>

    {{-- <div class="w-full h-6 flex items-center justify-center mt-4 bg-custom py-6">
      <h2 class="text-center  text-white">All Rights Reserved Copyright 2024. Design by  Blankson Obeng </h2>
    </div> --}}
  </div>
  
  
  <style>
    /* Customize the position and styles of alerts */
    #swal2-container {
      z-index: 9999 !important;
    }
    .bg-custom {
       background-color: #1f2937;
    }
  </style>
  
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>

