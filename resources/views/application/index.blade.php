@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の申し込み画面です。')
@section('title', '音楽科卒業演奏会 - 申込画面')

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