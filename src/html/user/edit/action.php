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
    $post = $_SESSION['edit_user_data'];

    $ins = new Base;

    // インスタンス生成、新規ユーザ登録する
    $DBins = new DB_Users;
    // trueならsuccessページへ遷移する
    $result = $DBins->userUpdate($post);
    if ($result == true) {
        unset($_SESSION['edit_user_data'],$_SESSION['exception']);
        header('Location:./success.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
