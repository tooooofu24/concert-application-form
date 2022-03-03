@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理者ログイン画面です。')
@section('title', '音楽科卒業演奏会 - ログイン画面')

@include('layouts.admin-navigation',['title'=>'管理者ログインページ'])
<div class="h-100 d-flex align-items-center">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ログイン</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(app()->isLocal()) {{ old('email', 'test@email.com') }} @else {{ old('email') }} @endif" required autocomplete="email" autofocus @if(app()->isLocal()) readonly @endif>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" @if(app()->isLocal()) value="password" readonly @endif>

                                    @error('password')
                                    <span class=" invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            ログイン情報を記憶する
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-0">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection