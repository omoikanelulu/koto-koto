<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Things.php';

Security::session();
// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// 送信されてきたデータをサニタイズして変数に代入
$input_thing = Security::sanitize($_POST);

// ここからバリデーション
// 文字数チェック
$result = Validation::llCheck($input_thing['thing'], Config::LL_THING);

if ($result == false) {
    $_SESSION['err']['err_llCheck'] = Config::ERR_LL_THING;
    header('Location:./index.php', true, 307);
    exit();
}

// ここまでバリデーション

$ins = new Base;
$DBins = new DB_Things;

try {
    $result = $DBins->thingsAdd($input_thing, $_SESSION['login_user']['id']);
    if ($result == true) {
        unset($_SESSION['input_thing'], $_SESSION['err']['err_llCheck'], $_SESSION['exception']);
        header('Location:./success.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
