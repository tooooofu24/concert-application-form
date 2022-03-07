@component('mail::message',['title'=>'アンケート回答のお願い'])

先日、3月5日に行われた「令和3年度千葉大学教育学部音楽科卒業演奏会」にお越しくださいました皆様、誠に有難うございます。<br>
来年度以降の千葉大学教育学部音楽科の卒業演奏会もお越しいただけましたら、非常に嬉しく思います。<br>
<br>
最後に、ご来場くださいました皆様にはこちらのアンケートへのご回答お願いしたく思っております。
アンケートの回答は、来年度以降の演奏会の参考にさせていただきます。

下記のURLより、アンケート回答のご協力お願い致します。


@component('mail::button', ['url' => 'https://forms.gle/i2PUReUxRWqNJ7WJ8'])
アンケートに回答する
@endcomponent

<span style="font-size: 80%;">
    ※上記のリンクがうまく動作しない場合は<a href="https://forms.gle/i2PUReUxRWqNJ7WJ8" target="_blank">こちら</a>からチケット画面をご確認いただけます。<br>
    ※何かご不明な点などありましたら<a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}?subject=お問い合わせ&body=お問い合わせ内容をご記入ください。%0D%0A返信は手動で行なっているため、お時間がかかることがあります。" target="_blank">こちら</a>からお問い合わせください。
</span>
@endcomponent