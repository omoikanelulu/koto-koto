<?php
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';

Security::session();

// 不要な$_SESSIONに残っている値を削除する
if (isset($_SESSION['err']) == true) {
    unset($_SESSION['err']);
}
if (isset($_SESSION['input_user_data']) == true) {
    unset($_SESSION['input_user_data']);
}
// $_SESSIONにverifiedがあればunsetする
if (isset($_SESSION['verified']['confirm']) == true) {
    unset($_SESSION['verified']['confirm']);
}

$ins = new Base;

header('Location:' . $ins->top_page_url);
exit();
