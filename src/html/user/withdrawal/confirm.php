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

$login_user = $_SESSION['login_user'];
$post = Security::sanitize($_POST);

// 入力されたIDとPASSをログイン情報と比較し、本人確認する
$check_id = Security::checkId($post['user_mail_address'], $post['pass']);

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

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand row" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item navbar-brand">
                            <h4><?= $ins->nav_title ?></h4>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-5 container">
            <form action="./action.php" method="POST">
                <fieldset disabled>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="mb-4 col">
                            <p>退会処理を行います、よろしいですか？<br>退会処理を行うと、ユーザ情報および、これまでに記録したデキゴト全てが消去されます！</p>
                            <p class="text-danger fw-bold">※この処理は取り消せません！</p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" id="user_name" value=<?= $login_user['user_name'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="family_name" class="form-label">姓</label>
                            <input type="text" class="form-control" id="family_name" value=<?= $login_user['family_name'] ?>>
                        </div>
                        <div class="col">
                            <label for="first_name" class="form-label">名</label>
                            <input type="text" class="form-control" id="first_name" value=<?= $login_user['first_name'] ?>>
                        </div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="user_mail_address" value=<?= $login_user['user_mail_address'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col"></div>
                    </div>
                </fieldset>
                <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                    <div class="col">
                        <button type="submit" class="me-3 btn btn-success">退会する</button>
                        <a href="./cancel.php"><button type="button" class="btn btn-danger">キャンセル</button></a>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php
        // デバッグ用 //
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
        ////////////////
        ?>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>