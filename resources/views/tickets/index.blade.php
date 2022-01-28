@extends('layouts.layout')

@section('content')
<nav class="navbar navbar-dark bg-dark navbar-expand-sm">
    <div class="container-fluid align-items-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">チケット一覧</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="mt-3">
        @if(session('message'))
        <div class="">
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        </div>
        @endif
        <div class="py-3">
            <form action="">
                <div class="row">
                    <div class="col pe-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="氏名を検索（ひらがなでも可）" id="q" name="q" value="{{ request()->q }}" />
                        </div>
                    </div>
                    <div style="width: 100px" class="d-flex justify-content-end align-items-center ps-0">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search me-2"></i>検索</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">id</th>
                        <th scope="col" class="text-nowrap">氏名</th>
                        <th scope="col" class="text-nowrap">メールアドレス</th>
                        <th scope="col" class="text-nowrap">電話番号</th>
                        <th scope="col" class="text-nowrap">入場時間</th>
                        <th style="width: 110px;" class="text-center text-nowrap">入場済/未入場</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr role="button" data-bs-toggle="modal" data-bs-target="#modal_{{ $ticket->id }}">
                        <td class="align-middle text-nowrap">{{ $ticket->id }}</td>
                        <td class="align-middle text-nowrap">{{ $ticket->name }}</td>
                        <td class="align-middle text-nowrap">{{ $ticket->email }}</td>
                        <td class="align-middle text-nowrap">{{ $ticket->tel }}</td>
                        <td class="align-middle text-nowrap">{{ optional($ticket->entered_at)->format('n/d G:s') }}</td>
                        <td class="align-middle text-center text-nowrap">
                            @if($ticket->entered_at)
                            <span class="badge bg-success">入場済</span>
                            @else
                            <span class="badge bg-danger">未入場</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($tickets as $ticket)
    <!-- Modal -->
    <div class="modal fade" id="modal_{{ $ticket->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">チケット情報詳細</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="p-1 col-sm-6">
                            <label for="name" class="form-label m-0">氏名</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center" style="width: 40px">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：千葉太郎" id="name" name="name" required value="{{ $ticket->name }}" style="pointer-events: none;" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="email" class="form-label m-0">メールアドレス</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center" style="width: 40px">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：chiba-univ@email.com" id="email" name="email" required value="{{ $ticket->email }}" style="pointer-events: none;" />
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="tel" class="form-label m-0">電話</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center" style="width: 40px">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：090-1234-5678" id="tel" name="tel" required value="{{ $ticket->tel }}" style="pointer-events: none;" />
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="zip" class="form-label m-0">郵便番号</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center" style="width: 40px">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：123-4567" id="zip" name="zip" maxlength="8" required value="{{ $ticket->zip }}" style="pointer-events: none;" />
                            </div>
                        </div>
                        <div class="p-1 col">
                            <label for="address" class="form-label m-0">住所</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center" style="width: 40px">
                                    <i class="fas fa-location-arrow"></i>
                                </span>
                                <textarea type="text" class="form-control" placeholder="例：千葉市稲毛区弥生町1-33" id="address" name="address" required value="{{ $ticket->address }}" style="pointer-events: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('tickets.destroy',['id'=>$ticket->id]) }}" method="POST" class="d-inline me-auto" onsubmit="return confirm('チケットを削除します。よろしいですか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除する</button>
                    </form>
                    @if($ticket->entered_at)
                    <button type="button" class="btn btn-success" disabled>入場済</button>
                    @else
                    <form action="{{ route('tickets.enter',['id'=>$ticket->id]) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">入場する</button>
                    </form>
                    @endif
                    <form action="" method="GET" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">メール再送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection