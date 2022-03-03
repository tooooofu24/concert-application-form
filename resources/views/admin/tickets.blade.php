@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理画面です。')
@section('title', '音楽科卒業演奏会 - チケット一覧')

@include('layouts.admin-navigation',['title'=>'卒業演奏会 チケット一覧'])
<div class="container-lg pt-5 mt-2" style="max-width: 50rem;">
    <div class="py-3">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="accordion mb-2" id="accordionFlushExample">
            <div class="accordion-item bg-white">
                <div class="accordion-header">
                    <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        詳細検索
                    </button>
                </div>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="mx-auto" style="max-width: 35rem;">
                            <form action="">
                                <div class="row mb-1">
                                    <div class="col-2 text-center">
                                        <div>
                                            <i class="fas fa-user fs-5" data-bs-toggle="tooltip" data-bs-placement="top" title="氏名"></i>
                                        </div>
                                        <div>
                                            <span class="badge text-muted p-0">氏名</span>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <input type="text" class="form-control bg-white" id="q" placeholder="氏名（ひらがな可）" name="q" value="{{ request()->q }}">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-2 text-center">
                                        <div>
                                            <i class="fas fa-walking fs-4" data-bs-toggle="tooltip" data-bs-placement="top" title="入場済/未入場"></i>
                                        </div>
                                        <div>
                                            <span class="badge text-muted p-0">状態</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row h-100 align-items-center">
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="enter" id="enter_all" value="0" @if(request()->enter != 1 && request()->enter != 2) checked @endif>
                                                <label class="btn btn-outline-success btn-sm" for="enter_all">全て</label>
                                            </div>
                                            <div class="col text-center">
                                                <input type="radio" class="btn-check" name="enter" id="enter_false" value="1" @if(request()->enter == 1 ) checked @endif>
                                                <label class="btn btn-outline-success btn-sm" for="enter_false">未入場</label>
                                            </div>
                                            <div class="col text-end">
                                                <input type="radio" class="btn-check" name="enter" id="enter_true" value="2" @if(request()->enter == 2 ) checked @endif>
                                                <label class="btn btn-outline-success btn-sm" for="enter_true">入場済</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-2 text-center">
                                        <div>
                                            <i class="fas fa-mobile-alt fs-5" data-bs-toggle="tooltip" data-bs-placement="top" title="申込方法"></i>
                                        </div>
                                        <div>
                                            <span class="badge text-muted p-0">予約</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row h-100 align-items-center">
                                            <div class="col">
                                                <input type="radio" class="btn-check" name="reserve" id="reserve_all" value="0" @if(request()->reserve != 1 && request()->reserve != 2) checked @endif >
                                                <label class="btn btn-outline-success btn-sm" for="reserve_all">全て</label>
                                            </div>
                                            <div class="col text-center">
                                                <input type="radio" class="btn-check" name="reserve" id="reserve_tel" value="1" @if(request()->reserve == 1 ) checked @endif>
                                                <label class="btn btn-outline-success btn-sm" for="reserve_tel">電話</label>
                                            </div>
                                            <div class="col text-end">
                                                <input type="radio" class="btn-check" name="reserve" id="reserve_sns" value="2" @if(request()->reserve == 2 ) checked @endif>
                                                <label class="btn btn-outline-success btn-sm" for="reserve_sns">SNS</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col"></div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary rounded-pill"><i class="fas fa-search me-2"></i>検索</button>
                                    </div>
                                    <div class="col d-flex justify-content-end align-items-end">
                                        <a class="btn btn-danger btn-sm rounded-pill" style="width: 2.2rem;" href="{{ route('tickets.index') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="検索条件のリセット"><i class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2 d-flex align-items-center">
            <span class="mx-1"><i class="fas fa-search"></i>：</span>
            @if(!request()->q && !request()->enter && !request()->reserve)
            <span class="badge bg-success mx-1">全て</span>
            @endif
            @if(request()->q)
            <span class="badge bg-success mx-1">{{ request()->q }}</span>
            @endif
            @if(request()->enter == 1)
            <span class="badge bg-success mx-1">未入場</span>
            @elseif(request()->enter == 2)
            <span class="badge bg-success mx-1">入場済</span>
            @endif
            @if(request()->reserve == 1)
            <span class="badge bg-success mx-1">電話</span>
            @elseif(request()->reserve == 2)
            <span class="badge bg-success mx-1">SNS</span>
            @endif
        </div>
        <div class="card">
            <div class="card-body px-1">
                <div class="table-responsive mx-auto" style="max-width: 35rem;">
                    <div class="container">
                        <div class="pb-1">
                            <div class="text-muted d-flex justify-content-between">
                                <span>
                                    検索結果 {{ $tickets->total() }}件
                                </span>
                                <span>
                                    ページ {{ $tickets->currentPage() }} / {{ $tickets->lastPage() }}
                                </span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($tickets as $ticket)
                            <button class="list-group-item list-group-item-action px-0 text-start" data-bs-toggle="modal" data-bs-target="#modal_{{ $ticket->id }}">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <div class="ps-3">
                                            @if($ticket->tel_reserved_flag)
                                            <i class="fas fa-phone-alt fa-lg"></i>
                                            @else
                                            <i class="fab fa-instagram fa-lg"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div><span class="fw-bold text-black text-opacity-75">{{ $ticket->name ?: $ticket->converted_name ?: '未入力' }}</span></div>
                                        @if($ticket->tel)
                                        <div class="text-muted text-truncate">{{ $ticket->tel }}</div>
                                        @else
                                        <div class="text-danger text-truncate">未入力</div>
                                        @endif
                                    </div>
                                    <div class="text-end col-3">
                                        @if($ticket->entered_at)
                                        <span class="badge bg-secondary my-auto p-2 position-relative me-3">
                                            入場済
                                            @if($ticket->isEmpty)
                                            <span class="position-absolute top-0 start-100 translate-middle border border-white badge rounded-circle bg-danger warning-badge align-items-center d-flex">
                                                <i class="fas fa-exclamation mx-auto"></i>
                                            </span>
                                            @endif
                                        </span>
                                        @else
                                        <span class="badge bg-danger my-auto p-2 position-relative me-3">
                                            未入場
                                            @if($ticket->isEmpty)
                                            <span class="position-absolute top-0 start-100 translate-middle border border-white badge rounded-circle bg-danger warning-badge align-items-center d-flex">
                                                <i class="fas fa-exclamation mx-auto"></i>
                                            </span>
                                            @endif
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </button>
                            @endforeach
                        </ul>
                    </div>
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
                    <span class="modal-title">チケット情報詳細</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tickets.update',['id'=>$ticket->id]+request()->query()) }}" method="POST" onsubmit="return confirm('チケットを更新します。よろしいですか？')">
                    @method('PUT')
                    @csrf
                    <div class="modal-body pt-0">
                        <div class="pt-2 text-end">
                            @if($ticket->entered_at)
                            <span class="badge bg-secondary me-1"><i class="fas fa-walking me-1"></i>入場済</span>
                            @else
                            <span class="badge bg-secondary me-1"><i class="fas fa-times me-1"></i>未入場</span>
                            @endif
                            @if($ticket->tel_reserved_flag)
                            <span class="badge bg-secondary"><i class="fas fa-phone-alt me-1"></i>電話受付</span>
                            @else
                            <span class="badge bg-secondary"><i class="fab fa-instagram me-1"></i>SNS受付</span>
                            @endif
                        </div>
                        <div class="row px-2">
                            <div class="p-1 col-sm-6">
                                <label for="name-{{$ticket->id}}" class="form-label m-0">氏名</label>
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @if(!$ticket->name) is-invalid @endif" placeholder="例：千葉太郎" id="name-{{$ticket->id}}" name="name" value="{{ $ticket->name }}" />
                                </div>
                            </div>
                            <div class="p-1 col-sm-6">
                                <label for="converted_name-{{$ticket->id}}" class="form-label m-0">ふりがな</label>
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <input type="text" class="form-control @if(!$ticket->converted_name) is-invalid @endif" placeholder="例：ちばたろう" id="converted_name-{{$ticket->id}}" name="converted_name" value="{{ $ticket->converted_name }}" />
                                </div>
                            </div>
                            <div class="p-1 col-sm-6">
                                <label for="email-{{$ticket->id}}" class="form-label m-0">メールアドレス</label>
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control @if(!$ticket->email) is-invalid @endif" placeholder="例：chiba-univ@email.com" id="email-{{$ticket->id}}" name="email" value="{{ $ticket->email }}" />
                                </div>
                            </div>
                            <div class="p-1 col-sm-6">
                                <label for="tel-{{$ticket->id}}" class="form-label m-0">電話</label>
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @if(!$ticket->tel) is-invalid @endif" placeholder="例：090-1234-5678" id="tel-{{$ticket->id}}" name="tel" value="{{ $ticket->tel }}" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer pt-1 border-0">
                        {{-- 削除ボタン --}}
                        <input form="delete-{{$ticket->id}}" type="submit" class="btn btn-danger rounded-pill fas" value="&#xf2ed;" data-bs-toggle="tooltip" data-bs-placement="top" title="チケットを削除" />
                        {{-- メール再送信ボタン --}}
                        <input form="mail-{{$ticket->id}}" type="submit" class="btn btn-success rounded-pill fas" value="&#xf0e0;" data-bs-toggle="tooltip" data-bs-placement="top" title="メールを再送信" />
                        {{-- 手動入場ボタン --}}
                        @if(!$ticket->entered_at)
                        <input form="enter-{{$ticket->id}}" type="submit" class="btn btn-primary rounded-pill fas" value="&#xf554;" data-bs-toggle="tooltip" data-bs-placement="top" title="手動で入場" />
                        @endif
                        {{-- 更新ボタン --}}
                        <input type="submit" class="btn btn-primary rounded-pill fw-bold h-auto ms-auto" value="更新" />
                    </div>
                </form>
                <form id="delete-{{$ticket->id}}" action="{{ route('tickets.destroy',['id'=>$ticket->id]) }}" method="POST" class="d-none" onsubmit="return confirm('チケットを削除します。よろしいですか？')">
                    @csrf
                    @method('DELETE')
                </form>
                <form id="mail-{{$ticket->id}}" action="{{ route('tickets.send-mail',['id'=>$ticket->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('メールを送信します。よろしいですか？')">
                    @csrf
                </form>
                <form id="enter-{{$ticket->id}}" action="{{ route('tickets.enter',['id'=>$ticket->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('入場処理をします。よろしいですか？')">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mb-4 d-flex justify-content-center">
    {{ $tickets->links() }}
</div>

{{-- 新規作成ボタン --}}
<div class="position-fixed bottom-0 end-0 p-3" style="width: fit-content; z-index: 2" data-bs-toggle="tooltip" data-bs-placement="left" title="チケット新規作成">
    <button class="btn btn-primary btn-xl shadow-lg rounded-circle" data-bs-toggle="modal" data-bs-target="#new_modal">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- 新規作成モーダル -->
<div class="modal fade" id="new_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">チケット新規作成</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row px-2">
                        <div class="p-1 col-sm-6">
                            <label for="name" class="form-label m-0">氏名</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：千葉太郎" id="name" name="name" />
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="converted_name" class="form-label m-0">ふりがな</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：ちばたろう" id="converted_name" name="converted_name" />
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="email" class="form-label m-0">メールアドレス</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：chiba-univ@email.com" id="email" name="email" />
                            </div>
                        </div>
                        <div class="p-1 col-sm-6">
                            <label for="tel" class="form-label m-0">電話</label>
                            <div class="input-group">
                                <span class="input-group-text d-flex justify-content-center">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="例：090-1234-5678" id="tel" name="tel" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-1 border-0">
                    <input type="submit" class="btn btn-primary rounded-pill fw-bold h-auto ms-auto" value="作成" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection