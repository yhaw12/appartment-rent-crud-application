<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <div class="flex">
    <!-- Sidebar -->
    <div class="w-1/3">
      @include('partials.sidebar')
    </div>
  
    <div class="w-2/3">
        <!-- Navbar -->
        <div class="navbar">
            Dashboard
            @include('partials.NavBar')
        </div>
  
        <!-- Content Area -->
        <div class="content">
          @yield('content')
        </div>
        
      
    </div>
  </div>
</body>
</html>
