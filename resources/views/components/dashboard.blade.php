<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="w-full h-screen px-20">
  <nav>
    <!-- Navbar content goes here -->
    @include('partials.NavBar')
  </nav>

  <div class="main-content">
    <aside>
      <!-- Sidebar content goes here -->
      @include('partials.sidebar')
    </aside>

    <section>
      <!-- Main content goes here -->
      @yield('content')
    </section>
  </div>

  <footer class="bg-slate-500">
    <!-- Footer content goes here -->
  </footer>
</body>
</html>