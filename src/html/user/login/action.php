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

unset($_SESSION['err']);

$post = Security::sanitize($_POST);

// ユーザのレコードが代入される
$rec = $login->userLogin($post);

if (empty($rec)) {
    $_SESSION['err']['err_userLogin'] = Config::$err_userLogin;
} elseif (password_verify($post['pass'], $rec['pass'])) {
    $_SESSION['login_user'] = $rec;
    unset($_SESSION['err']);
    header('Location:'.$ins->things_top_page_url);
    exit();
} else {
    $_SESSION['err']['err_userLogin'] = Config::$err_userLogin;
}

header('Location:./index.php');
exit();
