<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// $_SESSIONに編集前のデキゴトがあればunsetする
if (isset($_SESSION['thing']) == true) {
    unset($_SESSION['thing']);
}
// $_SESSIONにユーザが入力したデータがあればunsetする
if (isset($_SESSION['edit_thing']) == true) {
    unset($_SESSION['edit_thing']);
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

header('Location:' . $ins->thing_show_page_url);
exit();
