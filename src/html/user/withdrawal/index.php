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

// トークン生成
$token = Security::makeToken();

$ins = new Base();

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
            <form action="./confirm.php" method="post">
                <input type="hidden" name="token" value="<?= $token ?>">
                <fieldset>
                    <div class="mb-4 row row-cols-2 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" name="user_mail_address" id="user_mail_address" placeholder="hoge@example.com">
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-2 d-flex justify-content-center">
                        <div class="col">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="your_password">
                        </div>
                    </div>
                </fieldset>
                <div class="row row-cols-2 d-flex justify-content-center">
                    <div class="col form-text text-danger">
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_checkId']) ? $_SESSION['err']['err_checkId'] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-2 d-flex justify-content-center">
                    <div class="col">
                        <input type="submit" class="me-3 btn btn-primary" value="ログイン">
                        <a href=<?= $ins->things_top_page_url ?>><input type="button" class="btn btn-danger" value="キャンセル"></a>
                    </div>
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
        exit();
        ////////////////
        ?>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>