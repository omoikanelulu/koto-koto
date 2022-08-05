<?php

class Config
{
    public static $first_year = '2020';
    public static $months = array('01,02,03,04,05,06,07,08,09,10,11,12');
    public static $days = array('01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31');

    public static $top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
    public static $things_top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php';
    public static $site_title = 'koto-koto';
    public static $test_msg = '入力内容が表示される';
    public static $session_info = 'sessionに保存した内容';
    public static $err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';

    public static $nav_menus = array( //navbarのページ選択メニュー項目
        "デキゴトを記録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php',
        "デキゴトを修正" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_edit.php',
        "デキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_show.php',
        "イイコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/good_things_show.php',
        "ヤナコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/bad_things_show.php',
        "削除済みデキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/deleted_things_show.php',
    );

    public static $nav_user_menus = array( //navbarのuserメニュー項目
        "ユーザ情報編集" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/edit/index.php',
        "ログアウト" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/logout/action.php',
        "退会する" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/withdrawal/index.php',
    );
}
