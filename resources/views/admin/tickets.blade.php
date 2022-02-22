@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理画面です。')
@section('title', '音楽科卒業演奏会 - 管理画面')

@include('layouts.admin-navigation',['title'=>'卒業演奏会 チケット管理画面'])
<div class="container-lg pt-5 mt-3">
    <div class="py-3">
        @if(session('message'))
        <div>
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        </div>
        @endif
        <div class="card p-2">
            <div class="card-body">
                <div class="">
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
                <div class="table-responsive border-0">
                    <table class="table table-hover caption-top rounded table-centered table-nowrap border-0">
                        <caption class="border-0">来場者 {{ count($tickets->where('entered_at', '<>', null)) }} / {{ count($tickets) }}人</caption>
                        <thead class="table-secondary border-0 rounded">
                            <tr class="border-0">
                                <th scope="col" class="text-nowrap border-0 text-center rounded-start">氏名</th>
                                <th scope="col" class="text-nowrap border-0 text-center">メールアドレス</th>
                                <th scope="col" class="text-nowrap border-0 text-center">電話番号</th>
                                <th scope="col" class="text-nowrap border-0 text-center">入場時間</th>
                                <th style="width: 110px;" class="text-center text-nowrap border-0 rounded-end">入場済/未入場</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr role="button" data-bs-toggle="modal" data-bs-target="#modal_{{ $ticket->id }}" class="border-0">
                                <td class="align-middle text-nowrap border-0 text-center rounded-start">{{ $ticket->name }}</td>
                                <td class="align-middle text-nowrap border-0 text-center">{{ $ticket->email }}</td>
                                <td class="align-middle text-nowrap border-0 text-center">{{ $ticket->tel }}</td>
                                <td class="align-middle text-nowrap border-0 text-center">{{ optional($ticket->entered_at)->format('H:s') }}</td>
                                <td class="align-middle text-center text-nowrap border-0 rounded-end">
                                    @if($ticket->entered_at)
                                    <span class="badge bg-secondary rounded-pill p-2">入場済</span>
                                    @else
                                    <span class="badge bg-danger rounded-pill p-2">未入場</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
                        <div class="p-1 col-12">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('tickets.destroy',['id'=>$ticket->id]) }}" method="POST" class="d-inline me-auto" onsubmit="return confirm('チケットを削除します。よろしいですか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-3">削除する</button>
                    </form>

                    <form action="{{ route('tickets.send-mail',['id'=>$ticket->id]) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success rounded-pill px-3">メール再送信</button>
                    </form>
                    @if($ticket->entered_at)
                    <button type="button" class="btn btn-primary rounded-pill px-3" disabled>入場済</button>
                    @else
                    <form action="{{ route('tickets.enter',['id'=>$ticket->id]) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary rounded-pill px-3">入場する</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection