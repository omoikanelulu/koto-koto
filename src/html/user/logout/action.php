<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';

// セッションスタート
Security::session();

// インスタンス作成
$ins = new Base();

unset($_SESSION['login_user']);

header('Location:'.$ins->top_page_url);

?>