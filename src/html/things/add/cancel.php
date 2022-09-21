<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// $_SESSIONにユーザが入力したデータがあればunsetする
if (isset($_SESSION['post_data']) == true) {
    unset($_SESSION['post_data']);
}
// $_SESSIONにエラーメッセージがあればunsetする
if (isset($_SESSION['err']) == true) {
    unset($_SESSION['err']);
}
// $_SESSIONにverifiedがあればunsetする
if (isset($_SESSION['verified']['confirm']) == true) {
    unset($_SESSION['verified']['confirm']);
}
if (isset($_SESSION['verified']['checkId']) == true) {
    unset($_SESSION['verified']['checkId']);
}
if (isset($_SESSION['verified']['action']) == true) {
    unset($_SESSION['verified']['action']);
}

$ins = new Base;

header('Location:' . $ins->things_top_page_url);
exit();
