<?php

$top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
$things_top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php';
$site_title = 'koto-koto';
$test_msg = '入力内容が表示される';
$session_info = 'sessionに保存した内容';
$err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';

// 年月日の期間を指定する
$years = years_select(2018, date('Y'));
$months = months_select(01, 12);
$days = days_select(01, 31);

$nav_menus = array( //navbarのページ選択メニュー項目
    "デキゴトを記録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php',
    "デキゴトを修正" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_edit.php',
    "デキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_show.php',
    "イイコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/good_things_show.php',
    "ヤナコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/bad_things_show.php',
    "削除済みデキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/deleted_things_show.php',
);

$nav_user_menus = array( //navbarのuserメニュー項目
    "ユーザ情報編集" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/edit/index.php',
    "ログアウト" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/logout/action.php',
    "退会する" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/withdrawal/index.php',
);

// class Config
// {
//     const top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
//     const site_title = 'koto-koto';
//     const test_msg = '入力内容が表示される';
//     const err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';
// }
