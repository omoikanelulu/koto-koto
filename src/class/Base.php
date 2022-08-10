<?php

class Base //クラスプロパティの値には動的な値を入れられない、入れたい場合は__construct()を使う
{
    // プロパティ
    public $top_page_url = null;
    public $things_top_page_url = null;
    public $test_msg = '入力内容が表示される';
    public $session_info = 'sessionに保存した内容';
    public $this_year = null;
    public $current_page = null;
    public $nav_title = null;
    public $nav_menus = null;
    public $nav_user_menus = null;

    // コンストラクタ
    public function __construct()
    {
        $this->top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php';
        $this->things_top_page_url = 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php';
        $this->this_year = date('Y');
        $this->current_page = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        //navbarのメニュー項目
        $this->nav_menus = array(
            'link' => array(
                "デキゴトを記録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php',
                "デキゴトを修正" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_edit.php',
                "デキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_show.php',
                "イイコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/good_things_show.php',
                "ヤナコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/bad_things_show.php',
                "削除済みデキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/deleted_things_show.php',
            ),
            'not_link' => array(
                "koto-kotoへようこそ" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php',
                "エラーが発生しました" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/error/index.php',
                "ログイン" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/login/index.php',
                "新規ユーザ登録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/add/index.php',
            )
        );

        // //navbarのメニュー項目
        // $this->nav_menus = array(
        //     "koto-kotoへようこそ" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/index.php',
        //     "エラーが発生しました" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/error/index.php',
        //     "ログイン" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/login/index.php',
        //     "新規ユーザ登録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/add/index.php',
        //     "デキゴトを記録" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/index.php',
        //     "デキゴトを修正" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_edit.php',
        //     "デキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/things_show.php',
        //     "イイコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/good_things_show.php',
        //     "ヤナコトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/bad_things_show.php',
        //     "削除済みデキゴトを表示" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/things/deleted_things_show.php',
        // );

        //navbarのuserメニュー項目
        $this->nav_user_menus = array(
            "ユーザ情報編集" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/edit/index.php',
            "ログアウト" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/logout/action.php',
            "退会する" => 'http://' . $_SERVER["HTTP_HOST"] . '/koto-koto/src/html/user/withdrawal/index.php',
        );

        // nav-barにリンク用のメニューを用意する
        foreach ($this->nav_menus['link'] as $key => $url) {
            if ($this->current_page == $url) {
                $this->nav_title = $key;
                break;
            }
        }
    }
}
