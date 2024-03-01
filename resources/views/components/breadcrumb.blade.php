@php
    $segments = Request::segments();
    $link = '';
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($segments as $segment)
            @php $link .= '/' . $segment @endphp
            @if(!$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $link }}">{{ ucfirst($segment) }}</a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($segment) }}</li>
            @endif
        @endforeach
    </ol>
</nav>
