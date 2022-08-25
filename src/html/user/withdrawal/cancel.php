<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// $_SESSIONにエラーメッセージがあればunsetする
if (isset($_SESSION['err'])) {
    unset($_SESSION['err']);
}

$ins = new Base;

header('Location:'.$ins->edit_page_url);
exit();
