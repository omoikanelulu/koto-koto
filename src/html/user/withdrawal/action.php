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
    $login_user = $_SESSION['login_user'];

    // actionページから戻ってきた場合は、トークンの確認を素通りさせる
    if (isset($_SESSION['verified']['action']) == true) {
        if ($_SESSION['verified']['action'] != 'OK') {
            // トークンの確認
            if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
                header('Location:../../error/index.php');
                exit('トークンが一致しません');
            }
        }
    }

    // トークンの確認の素通りを解除する
    if (isset(($_SESSION['verified']['action'])) == true) {
        unset($_SESSION['verified']['action']);
    }

    $ins = new Base;
    $DBins = new DB_Users;

    // userUpdateを呼び出す
    $result = $DBins->deletedFlagOn($login_user);
    // trueならsuccessページへ遷移する
    if ($result == true) {
        unset($_SESSION['edit_user_data'], $_SESSION['exception'], $_SESSION['err']);
        header('Location:./success.php');
        exit();
    } else {
        throw new Exception('UPDATEに失敗しました');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}
