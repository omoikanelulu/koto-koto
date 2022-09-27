<?php
require_once '../class/Config.php';
require_once '../class/Base.php';
require_once '../class/Security.php';

Security::session();

// インスタンス生成
$ins = new Base();

// ログイン済みの場合はそちらにリダイレクト
if (isset($_SESSION['login_user']) == true) {
    header('Location:' . $ins->things_top_page_url);
    exit();
}

// トークンの生成
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
    <link rel="stylesheet" href="../css/custom.css">
    <title><?= $ins->nav_title ?></title>
</head>

<body class="bg-light mt-5">

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
            <div class="row g-0">
                <div class="col-md-8 offset-md-2 d-md-flex">
                    <form action="./user/login/index.php" method="post">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <button class="btn btn-primary" type="submit">ログイン</button>
                    </form>
                    <form action="./user/add/index.php" method="post">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <button class="btn btn-success" type="submit">新規登録</button>
                    </form>
                    <!-- <a href="./user/logout/action.php"><button type="button" class="btn btn-danger">開発用ログアウトボタン</button></a> -->
                </div>
            </div>
            <div class="row g-0">
                <div class="mb-2 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>使い方</h5>
                        </div>
                        <div class="card-body">
                            <ol>
                                <li class="card-text">深く考えずにメモ感覚でデキゴトを記録する</li>
                                <li class="card-text">記録したデキゴトをふり返る</li>
                                <li class="card-text">そのデキゴトがイイコトだったのかヤナコトだったのか仕分ける</li>
                                <li class="card-text">今日のイイコトベスト3を決める（就寝前に行うのが良い）</li>
                                <li class="card-text">ヤナコトに対する対処法を考える（ストレスに対する対処法を持つ事でストレス軽減に繋がる）</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>なぜなに「koto-koto」</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2 card-text">何をするサイトなの？</h5>
                            <p class="card-text">当サイトは日々のデキゴトを記録し、イイコト（良かった事、楽しかった事、嬉しかった事など）を振り返ったり、
                                ヤナコト（悪かった事、悲しかった事、辛かった事など）に対してどの様に対処するのか考える事で、</p>
                            <ul>
                                <li class="card-text">自己肯定感の向上</li>
                                <li class="card-text">ストレスに対する対処の仕方を考え日々のストレスを軽減する</li>
                            </ul>
                            <p class="card-text">といった、セルフケアのお手伝いが出来れば良いな、という趣旨で制作しております。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    </div>



    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<footer>

    <?php
    // デバッグ用 //
    // echo '<pre>';
    // echo 'セッションID<br>';
    // var_dump($_COOKIE['PHPSESSID']);
    // echo 'セッションの中身<br>';
    // var_dump($_SESSION);
    // echo '</pre>';
    ////////////////
    ?>

</footer>

</html>