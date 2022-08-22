<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// $_SESSIONにユーザがインプットしたデータがあればunsetする
if (isset($_SESSION['input_user_data'])) {
    unset($_SESSION['input_user_data']);
}
// $_SESSIONにエラーメッセージがあればunsetする
if (isset($_SESSION['err'])) {
    unset($_SESSION['err']);
}
// $_SESSIONにverifiedがあればunsetする
if (isset($_SESSION['verified'])) {
    unset($_SESSION['verified']);
}

$ins = new Base;

header('Location:'.$ins->edit_page_url);
exit();
