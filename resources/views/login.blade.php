@extends('layout')

@section('content')
    <main class="bg-gray-200 flex items-center justify-center h-screen">
        <title>Login Form</title>
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-md overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="w-full p-3 px-6 py-10">
                    <h2 class="text-center font-bold text-3xl">Login Form</h2>
                    <form method="POST" action="/user" class="mt-6">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="text-xs font-semibold px-1">Email:</label>
                            <input type="email" id="email" name="email" required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                        </div>

                        <div class="form-group mt-4">
                            <label for="password" class="text-xs font-semibold px-1">Password:</label>
                            <input type="password" id="password" name="password" required class="border w-full p-2 mt-2 text-lg text-gray-700 outline-none focus:border-indigo-500">
                        </div>

                        <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
