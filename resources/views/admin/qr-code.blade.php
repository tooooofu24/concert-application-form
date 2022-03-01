@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理画面です。')
@section('title', '音楽科卒業演奏会 - QRコード')

@include('layouts.admin-navigation',['title'=>'卒業演奏会 QRコード'])
<div class="h-100 d-flex align-items-center justify-content-center">
    {!! QrCode::size(200)->generate( route('application.index') ) !!}
</div>

@endsection