@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理画面です。')
@section('title', '音楽科卒業演奏会 - 受付フロー')

@include('layouts.admin-navigation',['title'=>'卒業演奏会 受付フロー'])

<div style="padding-top: 4rem;">
    <div class="col-lg-6 col-md-8 mx-auto">
        <img class="how-to-img d-block" src="{{ asset('svg/how-to.svg') }}">
    </div>
</div>
@endsection