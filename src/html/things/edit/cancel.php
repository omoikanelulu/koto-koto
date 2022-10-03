<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Util.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// キャンセル処理
Util::thingsCancel();

$ins = new Base;

header('Location:' . $ins->thing_show_page_url);
exit();
