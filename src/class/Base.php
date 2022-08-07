<?php

class Base //クラスプロパティの値には動的な値を入れられない、入れたい場合は__constract()を使う
{
    public function __constract()
    {
        // プロパティ
        $top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
        $things_top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php';
        $site_title = 'koto-koto';
        $test_msg = '入力内容が表示される';
        $session_info = 'sessionに保存した内容';
        $err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';

        $current_page = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        //navbarのページ選択メニュー項目
        $nav_menus = array(
            "デキゴトを記録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php',
            "デキゴトを修正" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_edit.php',
            "デキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_show.php',
            "イイコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/good_things_show.php',
            "ヤナコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/bad_things_show.php',
            "削除済みデキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/deleted_things_show.php',
        );

        //navbarのuserメニュー項目
        $nav_user_menus = array(
            "ユーザ情報編集" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/edit/index.php',
            "ログアウト" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/logout/action.php',
            "退会する" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/withdrawal/index.php',
        );

        // ページに合わせてメニューの表示を変えるメソッド
        foreach ($nav_menus as $menu => $url) {
            if ($current_page == $url) {
                $nav_title = $menu;
                break;
            }
        }
        return $nav_title = $menu;
    }
}
