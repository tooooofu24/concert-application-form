@extends('layouts.layout')

@section('content')

@section('title', '音楽科卒業演奏会 - 申込完了画面')

@include('layouts.public-navigation')
<div class="h-100 d-flex align-items-center">
    <div class="container-lg pt-4">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="card rounded-3">
                <div class="card-body">
                    <p class="card-title fs-4">申し込みが完了しました！</p>
                    <p class="card-text" style="font-size: 0.7rem;">
                        ご登録のメールアドレス宛にチケット情報をお送りしました。<br>
                        当日、入場の際にそちらのメールに添付されているURLをご準備の上ご来場ください。<br>
                        万が一、メールが届いていない場合はお手数ですが、<a href="mailto:admin@chiba-u-concert-2021.sumomo.ne.jp?subject=お問い合わせ&body=お問い合わせ内容をご記入ください。%0D%0A返信は手動で行なっているため、お時間がかかることがあります。">こちらのリンク</a>からお問い合わせください。
                    </p>
                    <a style="font-size: 0.7rem;" href="{{ route('application.index') }}" class="card-link">申し込み画面に戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection