<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <main class="bg-gray-200 flex items-center justify-center h-screen">
        <title>Signup Form</title>
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-md overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="w-full p-3 px-6 py-10">
                    <div class="inline-flex items-center justify-end border ">
                        <span class="text-blue">Have an Account </span>
                        <a href="{{ url('login') }}" class="text-xs border bg-red-500 text-white p-3 ml-4">LOGIN</a>
                    </div>
                    
                    <h2 class="text-center font-bold text-3xl">Signup Form</h2>
                    <form method="POST" action="/users" class="mt-6">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-xs font-semibold px-1">Name:</label>
                            <input type="text" id="name" name="name" value='{{old('name')}}' required  class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
    
                        <div class="form-group mt-4">
                            <label for="email" class="text-xs font-semibold px-1">Email:</label>
                            <input type="email" id="email" name="email"  value='{{old('email')}}' required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
    
                        <div class="form-group mt-4">
                            <label for="password" class="text-xs font-semibold px-1">Password:</label>
                            <input type="password" id="password" name="password"  value='{{old('password')}}' required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                        </div>
    
                        <div class="form-group mt-4">
                            <label for="password_confirmation" class="text-xs font-semibold px-1">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"  required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                        </div>
    
                        <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
  
</body>
</html>


