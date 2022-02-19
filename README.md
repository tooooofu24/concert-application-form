## 🎶 千葉大学音楽科コンサート申込フォーム
友達の卒業コンサートの申し込みフォームを作成しました。  
機能としては、①申し込み、②チケットの発行、③参加者の管理の3つです。

## 🎼 作成経緯
友達が学科の卒業コンサートを行うということを知ったのがきっかけでした。  
その友達が申し込みの方法を迷っていたところを、私が「作成しようか」と提案して開発が始まりました。

## 🎧 作成したページ(下記のURLには開発用のダミーデータが入っています。)
- [申込ページ](https://concert-application-form-sample.ms2n-xxx.com/application)
![image](https://user-images.githubusercontent.com/64852221/154796455-4fbe663a-2d51-4c68-9116-5bed1a3d0403.png)
- [管理者画面](https://concert-application-form-sample.ms2n-xxx.com/admin/tickets)
![image](https://user-images.githubusercontent.com/64852221/154796480-25643947-5fa3-40fb-b482-8a5ee72c894f.png)
- [チケットページ(サンプル)](https://concert-application-form-sample.ms2n-xxx.com/tickets/sample)
![image](https://user-images.githubusercontent.com/64852221/154796497-d33be233-25bd-4d64-9774-e8ccab197756.png)
- [メールデザイン](https://concert-application-form-sample.ms2n-xxx.com/admin/email-test)
![image](https://user-images.githubusercontent.com/64852221/154796726-45d9202c-9f06-48f9-a0ee-8f621f3d2df8.png)

## 💪 拘った点
>**Vue.jsを使ったバリデーション**  

[申込ページ](https://concert-application-form-sample.ms2n-xxx.com/application)で、@blurを使い、フォーカスが外れた際にバリデーションをかけるようにしました。フォームを送信する前に入力の間違いに気づくことができるため、UXの向上が期待できます。  

>**平仮名検索機能**  

[管理者画面](https://concert-application-form-sample.ms2n-xxx.com/admin/tickets)で平仮名の検索に対応しました。演奏会当日に口頭で名前を言われた際にも対応できます。

>**チケット画面のUI・UX**  

[チケット画面](https://concert-application-form-sample.ms2n-xxx.com/tickets/sample)はスワイプで直感的に使用できることを目指しました。デザイン科の生徒が描いてくれたデザインを使用しています。

## 🎷 使用技術
- Laravel 8.81.0
- Vue.js 3.x
- [Keen Slider(JavaScriptのライブラリ)](https://keen-slider.io/)
- Bootstrap
- [ConoHaのVPS(Apache、MySQL)](https://www.conoha.jp/vps/?btn_id=top--mainvisual_vps-top)
- さくらのレンタルサーバ(メールサーバ)
