@extends('layouts.layout')

@section('content')
@include('layouts.public-navigation')
<div class="h-100 d-flex align-items-center">
    <div class="container-lg pt-4">
        @if(session('message'))
        <div class="">
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        </div>
        @endif
        <application-form-component :errors='@json($errors->messages())' :old='@json(old())'></application-form-component>
    </div>
</div>
@endsection