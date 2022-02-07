@extends('layouts.layout')

@section('content')
@include('layouts.public-navigation')
<div class="h-100 d-flex align-items-center">
    <div class="container-lg pt-4">
        @if(isset($ticket))
        <ticket-component :uid='@json($ticket->uid)' :is_used_data='@json($ticket->entered_at != null)'></ticket-component>
        @else
        <ticket-component uid="sample" :is_used_data="false"></ticket-component>
        @endif
    </div>
</div>
@endsection