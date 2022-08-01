<?php

$top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
$things_top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php';
$site_title = 'koto-koto';
$test_msg = '入力内容が表示される';
$session_info = 'sessionに保存した内容';
$err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';

//urlの指定って絶対パスでないと駄目かと思ったけど、なんでこれでOkなんだぜ？
$menu_urls = array( //nav_barのメニュー項目
    "デキゴトを記録" => "index.php",
    "デキゴトを修正" => "things_edit.php",
    // "デキゴトを表示絶対パス" => $_SERVER["HTTP_HOST"] . "koto-koto/src/html/things/things_show.php",
    "デキゴトを表示" => "things_show.php",
    "イイコトを表示" => "good_things_show.php",
    "ヤナコトを表示" => "bad_things_show.php",
    "削除済みデキゴトを表示" => "deleted_things_show.php"
);

// class Config
// {
//     const top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
//     const site_title = 'koto-koto';
//     const test_msg = '入力内容が表示される';
//     const err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';
// }
