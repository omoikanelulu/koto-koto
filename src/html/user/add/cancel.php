<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';

Security::session();

// $_SESSIONにエラーメッセージがあればunsetする
if (isset($_SESSION['err']) == true) {
    unset($_SESSION['err']);
}

$ins = new Base;

header('Location:' . $ins->top_page_url);
exit();
