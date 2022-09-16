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

        // セッションクッキーの削除、time()ってなんぞ？
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
     * 本人確認メソッド
     * 入力されたIDとPASSが$_SESSION['login_user']の情報と同一かチェックする
     */
    public static function checkId($mail, $pass, $login_mail, $login_pass)
    {
        if (!empty($mail) && !empty($pass) && !empty($login_mail) && !empty($login_pass)) {
            // このように、引数で渡さずとも$_SESSIONから引っ張ってくるやり方もあり
            // if (!empty($mail) && !empty($pass) && !empty($_SESSION['login_user']['user_mail_address']) && !empty($_SESSION['login_user']['pass'])) {
            if ($mail == $login_mail && password_verify($pass, $login_pass)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * CSRF（クロスサイトリクエストフォージェリ）対策
     * $_SESSION['token']に保存
     */
    public static function makeToken()
    {
        // トークンの生成
        // 暗号学的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        // 生成したトークンをセッションに保存
        $_SESSION['token'] = $token;
        return $token;
    }

    /**
     * CSRF（クロスサイトリクエストフォージェリ）対策
     * $_SESSION['token']と$_POST['token']が同一であるかチェックする
     */
    public static function matchedToken($post_token, $session_token): bool
    {
        if (empty($session_token) || empty($post_token) || $session_token !== $post_token) {
            return false; // 一致せず
        } else {
            unset($session_token);
            return true; // 一致した
        }
    }
}
