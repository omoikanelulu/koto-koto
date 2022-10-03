<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// confirmページから戻ってきた場合は、トークンの確認を素通りさせる
if (isset($_SESSION['verified']['confirm']) == true && $_SESSION['verified']['confirm'] != 'OK') {
    // トークンの確認
    if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
        header('Location:../../error/index.php');
        exit('トークンが一致しません');
    }
}

// トークンの確認の素通りを解除する
if (isset($_SESSION['verified']['confirm']) == true) {
    unset($_SESSION['verified']['confirm']);
}

// 新しいトークンの生成
$token = Security::makeToken();

$ins = new Base();

$post = Security::sanitize($_POST);

if (isset($post)) {
    if (!isset($_SESSION['verified']['checkId']) || $_SESSION['verified']['checkId'] != 'OK') {
        // 入力されたIDとPASSをログイン情報と比較し、本人確認する
        $check_id = Security::checkId($post['user_mail_address'], $post['pass'], $_SESSION['login_user']['user_mail_address'], $_SESSION['login_user']['pass']);

        // NGの場合はエラーメッセージを出して前のページに遷移
        if ($check_id == false) {
            $_SESSION['err']['err_checkId'] = Config::ERR_CHECK_ID;
            header('Location:./index.php', true, 307);
            exit();
        } else {
            // 通過したタイミングでエラーメッセージと、verifiedを削除する
            unset($_SESSION['err']['err_checkId']);
            unset($_SESSION['verified']['checkId']);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cssの読み込み -->
    <link rel="stylesheet" href="../../../css/bootstrap5.1.3/dist/css/bootstrap.min.css">
    <!-- 自作cssの読み込み -->
    <link rel="stylesheet" href="../../../css/custom.css">
    <title><?= $ins->nav_title ?></title>
</head>

<body class="bg-light mt-5 mb-5">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand row" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item navbar-brand">
                        <h4><?= $ins->nav_title ?></h4>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <form action="./confirm.php" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                <fieldset>
                    <div class="row mb-4">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <p>編集する項目にチェックを入れてください</p>
                        </div>
                    </div>
                    <!-- 新規ユーザ名入力 -->
                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <label for="cb_user_name" class="form-label">
                                <input <?= empty($_SESSION['edit_user_data']['user_name']) ? '' : 'checked' ?> type="checkbox" id="cb_user_name" value="on" onclick="userNameDisabled('user_name',this.checked);">新しいユーザ名
                            </label>
                            <input <?= empty($_SESSION['edit_user_data']['user_name']) ? 'disabled' : '' ?> type="text" class="form-control" name="user_name" id="user_name" value="<?= isset($_SESSION['edit_user_data']['user_name']) ? $_SESSION['edit_user_data']['user_name'] : '' ?>">
                        </div>
                        <div class="col-md-8 offset-md-2 mb-2 form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_user_name']) ? $_SESSION['err']['err_ll_user_name'] : '' ?>
                        </div>
                    </div>

                    <!-- 新規メールアドレス入力 -->
                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <label for="cb_user_mail_address" class="form-label">
                                <input <?= empty($_SESSION['edit_user_data']['user_mail_address']) ? '' : 'checked' ?> type="checkbox" id="cb_user_mail_address" value="on" onclick="userMailAddressDisabled('user_mail_address',this.checked);">新しいメールアドレス
                            </label>
                            <input <?= empty($_SESSION['edit_user_data']['user_mail_address']) ? 'disabled' : '' ?> type="email" class="form-control" name="user_mail_address" id="user_mail_address" value="<?= isset($_SESSION['edit_user_data']['user_mail_address']) ? $_SESSION['edit_user_data']['user_mail_address'] : '' ?>">
                        </div>
                        <div class="col-md-8 offset-md-2 mb-2 form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_user_mail_address']) ? $_SESSION['err']['err_ll_user_mail_address'] : '' ?>
                        </div>
                    </div>

                    <!-- 新規パスワード入力 -->
                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <label for="cb_pass" class="form-label">
                                <input <?= empty($_SESSION['edit_user_data']['pass']) ? '' : 'checked' ?> type="checkbox" id="cb_pass" value="on" onclick="userMailAddressDisabled('pass',this.checked);">新しいパスワード
                            </label>
                            <input <?= empty($_SESSION['edit_user_data']['pass']) ? 'disabled' : '' ?> type="password" class="form-control" name="pass" id="pass" value="<?= isset($_SESSION['edit_user_data']['pass']) ? $_SESSION['edit_user_data']['pass'] : '' ?>">
                        </div>
                        <div class="col-md-8 offset-md-2 mb-2 form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_pass']) ? $_SESSION['err']['err_ll_pass'] : '' ?>
                        </div>
                    </div>
                </fieldset>

                <!-- 入力値がない時のエラーメッセージ表示 -->
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 mb-2 form-text text-danger">
                        <?= isset($_SESSION['err']['err_isArrayEmpty']) ? $_SESSION['err']['err_isArrayEmpty'] : '' ?>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" id="submit" class="me-3 btn btn-success">編集する</button>
                        <a href="./cancel.php"><button type="button" class="btn btn-danger">キャンセル</button></a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/script.js"></script>
</body>

</html>