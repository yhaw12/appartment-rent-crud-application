<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="w-full h-screen mx-10">
  <div class=" flex w-screen">
    <!-- Sidebar -->
    <div class=" p-4 border outline">
      
    </div>
  
    <div class="w-full flex-grow  p-4 border outline ">
        <!-- Navbar -->
        <div>
            Dashboard
            @include('partials.NavBar')
        </div>
  
        <!-- Content Area -->
        <div class="content">
          content
          @yield('content')
        </div>
    </div>
  </div>
</body>
</html>
