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

// 新しいトークンの生成
$token = Security::makeToken();

$ins = new Base();

$login_user = $_SESSION['login_user'];
$post = Security::sanitize($_POST);

// 入力されたIDとPASSをログイン情報と比較し、本人確認する
$check_id = Security::checkId($post['user_mail_address'], $post['pass'], $_SESSION['login_user']['user_mail_address'], $_SESSION['login_user']['pass']);

// NGの場合はエラーメッセージを出して前のページに遷移
if ($check_id == false) {
    $_SESSION['err']['err_checkId'] = Config::ERR_CHECK_ID;
    header('Location:./index.php', true, 307);
    exit();
} else {
    // 通過したタイミングでエラーメッセージを削除する
    unset($_SESSION['err']['err_checkId']);
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
            <form action="./action.php" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-md-8  offset-md-2 mb-4">
                            <p>退会処理を行います、よろしいですか？<br>退会処理を行うと、ユーザ情報および、これまでに記録したデキゴト全てが消去されます！</p>
                            <p class="text-danger fw-bold">※この処理は取り消せません！</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8  offset-md-2 mb-4">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" id="user_name" value=<?= $login_user['user_name'] ?>>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4  offset-md-2">
                            <label for="family_name" class="form-label">姓</label>
                            <input type="text" class="form-control" id="family_name" value=<?= $login_user['family_name'] ?>>
                        </div>
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">名</label>
                            <input type="text" class="form-control" id="first_name" value=<?= $login_user['first_name'] ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8  offset-md-2 mb-4">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="user_mail_address" value=<?= $login_user['user_mail_address'] ?>>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-8  offset-md-2 mb-4">
                        <button type="submit" class="me-3 btn btn-success">退会する</button>
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