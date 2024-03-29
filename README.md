## ローカルサイト
MAMP版
http://localhost/sangyo/public/

## 機能  
  
【実装済】  
 - 投稿データを表示(ペジーネーション付)  
 - 各レコードの詳細、削除リンク  
 - 新規投稿リンク  
 - 投稿者名(username)でキーワード検索  
 - カテゴリで絞り込み  
 - タイトルが長い場合、抜粋表示する  
 - 削除ボタンクリック時、確認ダイアログを出す

【未実装】  
 - いいね数  
 - 本文(body1,2,3)でもキーワード検索  

【実装しない】  
 - 投稿の編集機能  
投稿に「いいね」を付けられる仕様のため、投稿内容を編集してしまうと、どの内容のときの「いいね」だかわからなくなるため。
(投稿内容を編集すると「いいね」数がリセットされる仕様も考えたが、それなら新しく投稿したほうが早いと判断した。)

## 画像のアップロード機能の注意事項

ファイルのアップロードが必要なプロジェクトディレクトリで、  
下記コマンドを実行しておく必要がある。  
これによりpublicディレクトリの下にstorageディレクトリのリンクが作成される。  

これをやらないと、画像が表示されないので忘れずにやる。
git cloneしてきたときも行う必要がある。

`php artisan storage:link`

参考：画像のアップロード機能 #Laravelの教科書  
https://note.com/laravelstudy/n/n038bd68f53a7#BkZEu


## 文字数カウント機能

 - フレームワーク  
vue.js

 - 機能  
新規投稿画面にて、フォームに入力された値をリアルタイムでカウントする

 - 問題点  
バリデーションに引っかかった場合、再度同じページリダイレクトされるが、その際、入力していた値がリセットされてしまう。  

 - 原因  
Laravelのold関数が、vueの以下の記述のせいで毎回空白で上書きされてしまう。
```
data: {
    myText: ''
    },
```

 - 解決方法1  
vueでなく、javascriptで実装した場合、old関数が使えるようになった。
しかし、同じページにリダイレクトさせるとoldで保持した値をカウントしてくれない。
ボタンを押した回数を数えるメソッドなので、oldの値を数えないのは当たり前なのだが。

 - 解決方法2(実装済)  
バリデーションに引っかかったあと、リダイレクトすることで問題が起きるのなら
未入力があったら、リダイレクトさせなければよい。  

送信ボタンを押せないようにするため、  
カテゴリ、タイトル、本文のinputフォームにrequiredと、バリデーションと同じ文字数制限を追加。  
```
<input maxlength='15'>
```

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
