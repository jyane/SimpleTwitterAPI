# Introduction
多くのレンタルサーバーで動く Twitter REST API を叩くシンプルなPHPライブラリです．
一部のレンタルサーバーでは`allow_url_fopen`が`Off`になっているので作成しました．
`file_get_contents()`の代わりに`curl_exec()`によって接続を行います．
今のところ特定のユーザーのツイートを取得することしかできません．

This is a simple PHP library for Twitter REST API.
Some rental servers do not allow `allow_url_fopen`.
Because, this library uses `curl_exec()` instead of `file_get_contents()`.

## Usage
`config.php`に適当な値を設定し，下記のように呼び出します．
Update `config.php`, and write like that:
```php
$twitterAPI = new TwitterAPI();
$twitterAPI->getUserTweets(
  array(
    'screen_name' => '@_jyane',
    'count' => 10
  )
);
```
See also `sample.php`.

