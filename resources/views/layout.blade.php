<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <div class=" w-full h-screen flex  border outline-4 pr-10">
    <!-- Sidebar -->
    <div class="h-1/3">
      @include('partials.SideBar')
    </div>
  
    <div class="w-full  top-0 border outline-4">
        <!-- Navbar -->
        @include('partials.NavBar')
  
        <!-- Content Area -->
        <div class=" mx-4 my-8">
          @yield('content')
        </div>
    </div>
  </div>
</body>
</html>
