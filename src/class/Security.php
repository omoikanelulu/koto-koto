<?php
require_once 'Base.php';

class Security
{
    // static $ins = new Base;

    /**
     * セッションを開始する
     */
    public static function session()
    {
        session_start();
        session_regenerate_id(true);
    }

    /**
     * まるっとログアウト処理
     */
    public static function logout()
    {
        // セッション変数を全て解除
        $_SESSION = array();

        // セッションクッキーの削除
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }

        // セッションを破棄する
        session_destroy();
    }

    /**
     * XSS（クロスサイトスクリプティング）対策
     * 受け取ったデータをサニタイズする
     */
    public static function sanitize($post)
    {
        foreach ($post as $key => $v) {
            // $post[$key] = htmlspecialchars($v, ENT_HTML5, 'UTF-8', true);
            // オプションは無しでもいけるはず
            $post[$key] = htmlspecialchars($v);
        }
        return $post;
    }

    /**
     * ログインされていない場合はindexにリダイレクトさせる
     * 同一ディレクトリのindexであるため注意
     */
    public static function notLogin()
    {
        $ins = new Base; // newする場所はfunctionかclass内で。class外でnewしてもclass内には影響がない
        if (empty($_SESSION['login_user'])) {
            // header('Location:'.self::$ins->top_page_url);
            header('Location:' . $ins->top_page_url);
            exit();
        }
    }

    /**
     * CSRF（クロスサイトリクエストフォージェリ）対策
     * $_SESSION['token']に保存
     */
    public static function makeToken(): string
    {
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }

    /**
     * CSRF（クロスサイトリクエストフォージェリ）対策
     * 受信側では、$_SESSION['token']と$_POST['token']が同一であるかチェックする
     * @param string $p_token ポストされてきたワンタイムトークン
     */
    public static function matched_token($p_token): bool
    {
        // ここが怪しいのかも
        // if (!isset($_SESSION['token']) || $_SESSION['token'] !== $p_token) {
        //     return false;
        // }
        // return true;

        if (empty($_SESSION['token']) || empty($p_token) || $_SESSION['token'] !== $p_token) {
            return false; // 一致せず
        } else {
            return true; // 一致した
        }
    }
}
