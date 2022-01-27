@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="mt-5">
        @if(session('message'))
        <div class="">
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        </div>
        @endif
        <application-form-component></application-form-component>
    </div>
</div>
@endsection