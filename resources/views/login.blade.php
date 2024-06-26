<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login form for ThomNat Apartment at Kasoa Timber market. Login or sign up for an account.">
  <title>Login Form - ThomNat Apartment</title>
  <!-- Include Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="w-full h-screen px-20">
  
  <main class="bg-gray-200 flex flex-col items-center justify-center h-screen">

    <div class="w-full h-16 inline-flex items-center justify-center border p-8 ">
        <span class="text-blue">Don't have an Account? </span>
        <a href="{{ url('register') }}" class="text-xs border bg-red-500 text-white p-3 ml-4 float-right">SIGNUP</a>
      </div>
    <title>Login Form</title>
    <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-md overflow-hidden md:max-w-2xl">
      <div class="md:flex">
        <div class="w-full p-3 px-6 py-10">
          <h2 class="text-center font-bold text-3xl">Login Form</h2>
          <form method="POST" action="/user" class="mt-6">
            @csrf
            <div class="form-group">
              <label for="email" class="text-xs font-semibold px-1">Email:</label>
              <input type="email" id="email" name="email" value='{{ old('email') }}' required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
            </div>
            <div class="form-group mt-4">
              <label for="password" class="text-xs font-semibold px-1">Password:</label>
              <input type="password" id="password" name="password" required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">Login</button>
          </form>
        </div>
      </div>
      <div class="bg-slate-500 p-6">
        <div class="text-black text-center">
            <p>Contact us to rent an apartment:</p>
            <p>Email: <a href="mailto:yooxing11@gmail.com">yooxing11@gmail.com</a></p>
            <p>Phone: <a href="tel:+233543325452">054 332 5452</a></p>
        </div>
      </div>
    </div>
  </main>

  <!-- JavaScript for notifications -->
  <script src="{{ asset('js/notifications.js') }}"></script>
</body>
</html>