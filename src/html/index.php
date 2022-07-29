<?php
require_once dirname(__DIR__) . '/class/config.php'; //絶対パス
// require_once '../class/config.php'; //相対パス
$nav_title = 'koto-kotoへようこそ';

// header("Location: http://" . $_SERVER["HTTP_HOST"] ."/shared_todo_lists_old/login/index.php");
// のようにして、絶対パスで記述するのも1つの手ですね。

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
    <title><?= $nav_title ?></title>
</head>


<body class="bg-light">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand row" href="#">
                    <h1><?= $site_title ?><span> |</span></h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item navbar-brand">
                            <h4><?= $nav_title ?></h4>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                user_name
                            </a>
                            <ul class="text-end dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">ログアウト</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-5 container">
            <p>プルダウンメニューが右に行かねぇ</p>
            <div class="row row-cols-2 d-flex justify-content-center">
                <div class="mb-4 col">
                    <a href="./user/login/index.php"><button type="button" class="me-3 btn btn-primary">ログイン</button></a>
                    <a href="./user/add/index.php"><button type="button" class="btn btn-success">新規登録</button></a>
                </div>
            </div>
            <div class="row row-cols-2 d-flex justify-content-center">
                <div class="col">
                    <div class="card mb-4">
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
            <div class="row row-cols-2 d-flex justify-content-center">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>なぜなに「koto-koto」</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2 card-text"><ins>何をするサイトなの？</ins></h5>
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
    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>