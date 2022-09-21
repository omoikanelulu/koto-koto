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
$post = Security::sanitize($_POST);

// good_thing_flagを立てる
if ($post['good_thing_rank'] != '--') {
    $post += (array('good_thing_flag' => '1'));
} else {
    $post += (array('good_thing_flag' => '0'));
}

// bad_thing_flagを立てる
if ($post['bad_thing_level'] != '--') {
    $post += (array('bad_thing_flag' => '1'));
} else {
    $post += (array('bad_thing_flag' => '0'));
}

// $_SESSIONに代入
$_SESSION['post_data'] = $post;

// ここからバリデーション
$has_err = '';
$result = '';
unset($_SESSION['err']);

// 文字数チェック
// 値が入っていたらチェックを開始する
if (!empty($post['thing'])) {
    $result = Validation::llCheck($post['thing'], Config::LL_THING);
    if ($result == false) {
        $_SESSION['err']['err_llThing'] = Config::ERR_LL_THING;
        $result = '';
        $has_err = true;
    }
}

// 値が入っていたらチェックを開始する
if (!empty($post['bad_thing_approach'])) {
    $result = Validation::llCheck($post['bad_thing_approach'], Config::LL_APPROACH);
    if ($result == false) {
        $_SESSION['err']['err_llApproach'] = Config::ERR_LL_APPROACH;
        $result = '';
        $has_err = true;
    }
}

// どこかでエラーがあったらページをリダイレクトで戻す
if ($has_err == true) {
    $_SESSION['verified']['action'] = 'OK';
    header('Location:./index.php', true, 307);
    exit();
}

// ここまでバリデーション

$ins = new Base;
$DBins = new DB_Things;

// データベースに登録
try {
    $result = $DBins->thingsAdd($_SESSION['post_data'], $_SESSION['login_user']['id']);
    if ($result == true) {
        unset($_SESSION['post_data'], $_SESSION['err']['err_llCheck'], $_SESSION['err']['err_llApproach'], $_SESSION['exception']);
        header('Location:./success.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
