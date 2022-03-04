@component('mail::message',['title'=>'演奏会の前日をお知らせします♪'])

「令和3年度千葉大学教育学部音楽科卒業演奏会」の公演前日となりました。<br>
日時・場所、チケットの内容のご確認をお願い致します。<br>
なお、チケットは当日受付にて確認致します。こちらのメールに添付されているチケット画面を<strong style="text-decoration: underline;">事前にご用意の上</strong>、受付にてご提示ください。

@component('mail::button', ['url' => route('application.show',['uid'=>$ticket->uid])])
チケット画面はこちら
@endcomponent

@component('mail::panel')
日時：2022年3月5日(土)<br>
場所：<a href="https://goo.gl/maps/qempHaxQhJtRaafg8" target="_blank">千葉県教育会館 新館 大ホール</a><br>
開場：12:15<br>
開演：12:30<br>
<a href="https://goo.gl/maps/qempHaxQhJtRaafg8" target="_blank">
    <img src="{{ asset('images/map.jpg') }}" alt="地図" width="100%" style="padding: 1rem 1rem 0 1rem;">
</a>
@endcomponent

明日千葉県教育会館にて、音楽科一同、ご来場を心よりお待ちしております！！

<span style="font-size: 80%;">
    ※ご来場の際は感染症対策のため、マスクの着用をお願いいたします。<br>
    ※上記のリンクがうまく動作しない場合は<a href="{{ route('application.show',['uid'=>$ticket->uid]) }}" target="_blank">こちら</a>からチケット画面をご確認いただけます。<br>
    ※何かご不明な点などありましたら<a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}?subject=お問い合わせ&body=お問い合わせ内容をご記入ください。%0D%0A返信は手動で行なっているため、お時間がかかることがあります。" target="_blank">こちら</a>からお問い合わせください。
</span>
@endcomponent