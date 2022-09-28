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

$ins = new Base();

// POSTされてきたデータをサニタイズして$postへ代入
$post = Security::sanitize($_POST);

// サニタイズ済みのデータをセッションに保存
$_SESSION['edit_user_data'] = $post;

// checkId()を通過した事を示す値を持たせる
$_SESSION['verified']['checkId'] = 'OK';

// 【バリデーション開始】
$has_ng = '';
$result = '';
unset($_SESSION['err']);

// $postの値全てが空の場合はNG
if (empty($post['user_name']) && empty($post['user_mail_address']) && empty($post['pass'])) {
    $_SESSION['err']['err_isArrayEmpty'] = Config::ERR_IS_ARRAY_EMPTY;
    $has_ng = true;
}

// user_nameの文字数チェック
if (isset($post['user_name']) == true) { // 変数が定義されている場合にチェックする
    $result = Validation::llUserName($post['user_name']);
    if ($result == false) { // NGの場合
        $_SESSION['err']['err_ll_user_name'] = Config::ERR_LL_USER_NAME;
        $has_ng = true;
    } else {
        $result = '';
    }
}

// user_mail_addressの文字数チェック
if (isset($post['user_mail_address']) == true) { // 変数が定義されている場合にチェックする
    $result = Validation::llUserMailAddress($post['user_mail_address']);
    if ($result == false) { // NGの場合
        $_SESSION['err']['err_ll_user_mail_address'] = Config::ERR_LL_USER_MAIL_ADDRESS;
        $has_ng = true;
    } else {
        $result = '';
    }
}

// passの文字数チェック
if (isset($post['pass']) == true) { // 変数が定義されている場合にチェックする
    $result = Validation::llPass($post['pass']);
    if ($result == false) { // NGの場合
        $_SESSION['err']['err_ll_pass'] = Config::ERR_LL_PASS;
        $has_ng = true;
    } else {
        $result = '';
    }
}

// チェックのどこかでNGがあった場合、入力画面にリダイレクトする。HTTPコード307はpostデータをそのまま引き継ぐ
if ($has_ng == true) {
    // 通行証を渡す
    $_SESSION['verified']['confirm'] = 'OK';
    header('location:./account_edit.php', true, 307);
    exit();
}

// 【バリデーション終了】
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
            <form action="./action.php" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                <fieldset disabled>
                    <div class="row mb-4">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <p>下記の内容で編集してよろしいですか？</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <label for="user_name" class="form-label">新しいユーザ名</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" value=<?= isset($post['user_name']) ? $post['user_name'] : '' ?>>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2 mb-2">
                            <label for="user_mail_address" class="form-label">新しいメールアドレス</label>
                            <input type="email" class="form-control" name="user_mail_address" id="user_mail_address" value=<?= isset($post['user_mail_address']) ? $post['user_mail_address'] : '' ?>>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-8 offset-md-2">
                            <label for="pass" class="form-label">新しいパスワード</label>
                            <input type="password" class="form-control" name="pass" id="pass" value=<?= isset($post['pass']) ? $post['pass'] : '' ?>>
                        </div>
                    </div>
                </fieldset>

                <!-- ボタン -->
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="me-3 btn btn-success">編集する</button>
                        <a href="./account_edit.php"><button type="button" class="me-3 btn btn-secondary">前の画面に戻る</button></a>
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
</body>

</html>