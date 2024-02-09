<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <div class=" w-full h-screen flex items-center">
    <!-- Sidebar -->
    <div>
      @include('partials.SideBar')
    </div>
  
    <div class="border outline-4">
        <!-- Navbar -->
        @include('partials.NavBar')
  
        <!-- Content Area -->
        <div class=" mx-4 my-8">
          content
          @yield('content')
        </div>
    </div>
  </div>
</body>
</html>
