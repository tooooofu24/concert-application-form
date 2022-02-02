@extends('layouts.layout')

@section('content')
@include('layouts.public-navigation')
<div class="h-100 d-flex align-items-center">
    <div class="container-lg pt-4">
        <ticket-component></ticket-component>
    </div>
</div>
@endsection