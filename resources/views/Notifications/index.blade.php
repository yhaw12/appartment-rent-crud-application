@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Notifications
                        <a href="{{ route('notification.mark-as-read') }}" class="btn btn-sm btn-primary float-right">Mark All as Read</a>
                    </div>

                    <div class="card-body">
                        @forelse($notifications as $notification)
                            @include('notifications.notification', ['notification' => $notification])
                        @empty
                            <p>No unread notifications.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
