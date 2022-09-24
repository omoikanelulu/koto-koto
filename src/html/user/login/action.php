<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();
$ins = new Base;
$login = new DB_Users;

// トークンの確認
if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
    header('Location:../../error/index.php');
    exit('トークンが一致しません');
}

// 新しいトークンの生成
$token = Security::makeToken();

// $_POSTされたデータをサニタイズ
$post = Security::sanitize($_POST);

// 配列$postの中に空の物がないかチェック
if (empty($post) == true) {
    // 空だったら通行証を持たせて前のページ戻す
    $_SESSION['verified']['action'] = 'OK';
    $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    header('Location:./index.php');
    exit();
}

// ログイン処理、ユーザのレコードが代入される
// ユーザのレコードに記録されているpassが入力されたpassと一致するか確認する
try {
    $rec = $login->userLogin($post);

    if (empty($rec) || $rec == false) { // レコードが取得できない場合
        $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    } elseif (password_verify($post['pass'], $rec['pass'])) { // レコードを取得し、パスワードが一致した場合
        $_SESSION['login_user'] = $rec;
        unset($_SESSION['err']);
        header('Location:' . $ins->things_top_page_url);
        exit();
    } else { // パスワードが一致しない場合
        $_SESSION['err']['err_userLogin'] = Config::ERR_USER_LOGIN;
    }
    // 通行証を渡して、ページを戻す
    $_SESSION['verified'] = 'action';
    header('Location:./index.php');
    exit();
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
