<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';

$ins = new Base();

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

<body class="bg-light">
<header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-text container-fluid row-cols-auto">
                <a class="navbar-brand" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::$site_title ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="row-cols-auto">
                        <ul class="navbar-nav me-auto mb-lg-0">
                            <!-- ここからドロップダウンメニュー -->
                            <!-- ページ移動メニュー -->
                            <li class="nav-item dropdown">
                                <p class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $ins->nav_title ?>
                                </p>
                                <ul class="text-start dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                    <?php foreach ($ins->nav_menus as $menu => $url) : ?>
                                        <li><a class="dropdown-item" href="<?= $url ?>"><?= $menu ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- ユーザメニュー -->
                    <ul class="navbar-nav mb-lg-0 d-flex justify-content-end">
                        <li class="nav-item dropstart">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                user_name
                            </a>
                            <ul class="text-start dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <?php foreach ($ins->nav_user_menus as $menu => $url) : ?>
                                    <li><a class="dropdown-item" href=<?= $url ?>><?= $menu ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>
                    <!-- ここまでドロップダウンメニュー -->
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-5 container">
            <form action="./action.php" method="post">
                <fieldset>
                    <div class="mb-4 row row-cols-2 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-2 d-flex justify-content-center">
                        <div class="col">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" id="pass" placeholder="your_password">
                        </div>
                    </div>
                </fieldset>
                <div class="row row-cols-2 d-flex justify-content-center">
                    <div class="col form-text text-danger">
                        NG message
                    </div>
                </div>
                <div class="row row-cols-2 d-flex justify-content-center">
                    <div class="col">
                        <input type="submit" class="me-3 btn btn-primary" value="ログイン">
                        <a href=<?= $ins->top_page_url ?>><input type="button" class="btn btn-danger" value="キャンセル"></a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>