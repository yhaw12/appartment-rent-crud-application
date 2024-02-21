@extends('layout')

@section('content')
<div id="appartmentList" class="w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 cursor-pointer">
    @foreach ($stores as $store)
    <div class="card w-full h-auto rounded-lg shadow-lg overflow-hidden transition-transform duration-200 transform hover:scale-105 {{ $store->status == 'vacant' ? 'bg-red-200' : 'bg-green-200' }}">
        <div class="card-body p-4">
            <h5 class="card-title text-center text-xl font-bold text-gray-800">{{ $store->house }}{{ $store->number }}</h5>
            <p class="card-text text-center text-sm text-gray-600">Status: <span class="capitalize">{{ $store->status }}</span></p>
            <!-- Display other apartment details as needed -->
        </div>
    </div>
    @endforeach
</div>
@endsection
