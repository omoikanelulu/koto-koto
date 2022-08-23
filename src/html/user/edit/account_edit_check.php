<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

$ins = new Base();

$post = Security::sanitize($_POST);

if (!isset($_SESSION['verified'])) {
    // 入力されたIDとPASSをログイン情報と比較し、本人確認する
    $check_id = Security::checkId($post['user_mail_address'], $post['pass']);

    // NGの場合はエラーメッセージを出して前のページに遷移
    if ($check_id == false) {
        $_SESSION['err']['err_checkId'] = Config::ERR_CHECK_ID;
        header('Location:./index.php', true, 307);
        exit();
    } else {
        // 通過したタイミングでエラーメッセージと、verifiedを削除する
        unset($_SESSION['err']['err_checkId']);
        unset($_SESSION['verified']);
    }
}

// デバッグ用 //
echo'<pre>';
var_dump($_SESSION);
echo'</pre>';
////////////////

?>