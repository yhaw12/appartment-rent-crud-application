@extends('layout')

@section('content')
    <div id="appartmentList" class="w-full mx-auto m-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($appartments as $apartment)
        <div class="card w-40 h-auto rounded-md px-4 outline-2 border cursor-pointer {{ $apartment->status == 'vacant' ? 'bg-red-400' : 'bg-green-200' }}">
            <div class="card-body">
                <h5 class="card-title text-center text-2xl">  {{ $apartment->house }}{{ $apartment->number }}</h5>
                <p class="card-text">Status: {{ ucfirst($apartment->status) }}</p>
                <!-- Display other apartment details as needed -->
            </div>
        </div>
        @endforeach
        
    </div>
@endsection
