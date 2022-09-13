<?php
try {
    require_once '../../../class/Config.php';
    require_once '../../../class/Base.php';
    require_once '../../../class/Security.php';
    require_once '../../../class/Validation.php';
    require_once '../../../class/DB_Base.php';
    require_once '../../../class/DB_Users.php';

    // セッションスタート
    Security::session();

    // トークンの確認
    if (Security::matchedToken($_POST['token']) == false) {
        header('Location:../../error/index.php');
        exit('トークンが一致しません');
    }

    $post = $_SESSION['input_user_data'];

    $ins = new Base;

    // インスタンス生成、新規ユーザ登録する
    $DBins = new DB_Users;
    // trueならsuccessページへ遷移する
    $result = $DBins->userAdd($post);
    if ($result == true) {
        unset($_SESSION['input_user_data'], $_SESSION['exception'], $_SESSION['token']);
        header('Location:./success.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
