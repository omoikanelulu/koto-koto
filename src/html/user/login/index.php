<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();

$ins = new Base();

// confirmページから戻ってきた場合は、トークンの確認を素通りさせる
if (isset($_SESSION['verified']['action']) == true && $_SESSION['verified']['action'] != 'OK') {
    // 通行証が確認出来ない場合、トークンの確認を行う
    if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
        header('Location:../../error/index.php');
        exit('トークンが一致しません');
    }
}

// トークンの確認の素通りを解除する
if (isset($_SESSION['verified']['action']) == true) {
    unset($_SESSION['verified']['action']);
}

// 新しいトークンの生成
$token = Security::makeToken();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cssの読み込み -->
    <link rel="stylesheet" href="../css/bootstrap5.1.3/dist/css/bootstrap.min.css">
    <!-- 自作cssの読み込み -->
    <link rel="stylesheet" href="../../../css/custom.css">
    <title><?= $ins->nav_title ?></title>
</head>

<body class="bg-light mt-5">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand row" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item navbar-brand">
                            <h4><?= $ins->nav_title ?></h4>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row g-0 mb-2">
                <div class="col-md-8 offset-md-2">
                    <form action="./action.php" method="post">
                        <fieldset>
                            <!-- 送信する内容 -->
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="user_mail_address" name="user_mail_address" placeholder="hoge@example.com">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="your_password">

                            <!-- エラーメッセージ -->
                            <div class="col-md-12 form-text text-danger">
                                <?= isset($_SESSION['err']['err_userLogin']) ? $_SESSION['err']['err_userLogin'] : '' ?>
                            </div>

                            <!-- ボタン -->
                            <div class="col-md-12">
                                <input type="submit" class="me-3 btn btn-primary" value="ログイン">
                                <a href="./cancel.php"><input type="button" class="btn btn-danger" value="キャンセル"></a>
                            </div>
                        </fieldset>
                    </form>
                </div>
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
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>