<?php
require_once '../../class/Config.php';
require_once '../../class/Base.php';
require_once '../../class/Security.php';
require_once '../../class/Validation.php';
require_once '../../class/DB_Base.php';
require_once '../../class/DB_Users.php';

Security::session();

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
    <link rel="stylesheet" href="../../css/custom.css">
    <title><?= $ins->nav_title ?></title>
</head>

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand row" href="#">
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
        <div class="mt-5 container-fluid">
            <div class="row">
                <div class="col-1 col-md-2 col-xl-3"></div>
                <div class="mb-4 col-10 col-md-8 col-xl-6">
                    <p class="mb-4"><?= Config::ERR_MSG ?></p>

                    <!-- エラーの情報を表示 -->
                    <?php
                    if (isset($_SESSION['err']) == true) {
                        echo '<pre>';
                        var_dump($_SESSION['err']);
                        echo '</pre>';
                    }
                    ?>
                    <!-- エラーの情報を表示 ここまで -->

                    <a href="../user/logout/action.php"><button type="button" class="btn btn-danger">ログアウト</button></a>
                </div>
                <div class="col-1 col-md-2 col-xl-3"></div>
            </div>
        </div>
    </main>
    <footer>
        <?php
        if (isset($_SESSION['exception']) == true) {
            echo '<pre>';
            var_dump($_SESSION['exception']);
            echo '</pre>';
        }
        ?>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>