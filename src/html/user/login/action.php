<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();
$ins = new Base;
$login = new DB_Users;

// $_POSTされたデータをサニタイズ
$post = Security::sanitize($_POST);

// 配列$postの中に空の物がないかチェック
if (empty($post) == true) {
    $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    header('Location:./index.php');
    exit();
}

// ログイン処理、ユーザのレコードが代入される
try {
    $rec = $login->userLogin($post);

    if (empty($rec) || $rec == false) {
        $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    } elseif (password_verify($post['pass'], $rec['pass'])) {
        $_SESSION['login_user'] = $rec;
        unset($_SESSION['err']);
        header('Location:' . $ins->things_top_page_url);
        exit();
    } else {
        $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    }
    header('Location:./index.php');
    exit();
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
