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

// トークンの確認
if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
    header('Location:../../error/index.php');
    exit('トークンが一致しません');
}

// 新しいトークンの生成
$token = Security::makeToken();

// 送信されてきたデータをサニタイズして変数に代入
$edit_thing = Security::sanitize($_POST);

// good_thing_flagを見直す
if ($edit_thing['good_thing_rank'] == '--') {
    $edit_thing['good_thing_flag'] = 0;
} else {
    $edit_thing['good_thing_flag'] = 1;
}

// bad_thing_flagを見直す
if ($edit_thing['bad_thing_level'] == '--') {
    $edit_thing['bad_thing_flag'] = 0;
} else {
    $edit_thing['bad_thing_flag'] = 1;
}

// $_SESSIONにも代入
$_SESSION['edit_thing'] = $edit_thing;

// ここからバリデーション
$has_err = '';
$result = '';
unset($_SESSION['err']);

// 文字数チェック
// 値が入っていたらチェックを開始する
if (!empty($edit_thing['thing'])) {
    $result = Validation::llCheck($edit_thing['thing'], Config::LL_THING);
}

if ($result == false) {
    $_SESSION['err']['err_llThing'] = Config::ERR_LL_THING;
    $result = '';
    $has_err = true;
}

// 値が入っていたらチェックを開始する
if (!empty($edit_thing['bad_thing_approach'])) {
    $result = Validation::llCheck($edit_thing['bad_thing_approach'], Config::LL_APPROACH);
}

if ($result == false) {
    $_SESSION['err']['err_llApproach'] = Config::ERR_LL_APPROACH;
    $result = '';
    $has_err = true;
}

// どこかでエラーがあったらページをリダイレクトで戻す
if ($has_err == true) {
    $_SESSION['verified']['action'] = 'OK';
    header('Location:./index.php?id=' . urlencode($edit_thing['get_id']), true, 307);
    exit();
}

// ここまでバリデーション

$ins = new Base;
$DBins = new DB_Things;

// データベースをUPDATE
try {
    $result = $DBins->thingUpDate($_SESSION['edit_thing'], $_SESSION['login_user']['id'], $_SESSION['thing']);
    if ($result == true) {
        unset($_SESSION['thing'], $_SESSION['edit_thing'], $_SESSION['err']['err_llCheck'], $_SESSION['err']['err_llApproach'], $_SESSION['exception']);
        header('Location:' . $ins->thing_show_page_url);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
