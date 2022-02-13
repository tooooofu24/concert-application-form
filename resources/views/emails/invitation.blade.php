@component('mail::message',['title'=>'お申し込みが完了しました♪'])

令和3年度千葉大学教育学部音楽科卒業演奏会にお申し込みいただき、誠にありがとうございます。<br>
演奏会当日は受付の際に、こちらのメールに添付されているチケット画面をご提示ください。

@component('mail::button', ['url' => route('application.show',['uid'=>$ticket->uid])])
チケット画面はこちら
@endcomponent

@component('mail::panel')
日時：2022年3月5日(土)<br>
場所：<a href="https://goo.gl/maps/qempHaxQhJtRaafg8" target="_blank">千葉県教育会館 新館 大ホール</a><br>
会場：12:15<br>
開演：12:30<br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3243.8769744093365!2d140.11978281525677!3d35.606101180211944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1526b6633d2ed995%3A0x7806d7aea6439b19!2z5Y2D6JGJ55yM5pWZ6IKy5Lya6aSoIOaWsOmkqA!5e0!3m2!1sja!2sjp!4v1644746111177!5m2!1sja!2sjp" width="100%" height="100px" style="border:0; margin-top:5px" allowfullscreen="" loading="lazy"></iframe>
@endcomponent

音楽科一同、ご来場を心よりお待ちしております。

<span style="font-size: 80%;">
    ※ご来場の際は感染症対策のため、マスクの着用をお願いいたします。<br>
    ※上記のリンクがうまく動作しない場合は<a href="{{ route('application.show',['uid'=>$ticket->uid]) }}" target="_blank">こちら</a>からチケット画面をご確認いただけます。
</span>
@endcomponent