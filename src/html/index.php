<?php
$site_title = 'koto-koto';
$nav_title = 'koto-kotoへようこそ';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cssの読み込み -->
    <!-- <link rel="stylesheet" href="../css/bootstrap5.1.3/dist/css/bootstrap.min.css"> -->
    <!-- 自作cssの読み込み -->
    <link rel="stylesheet" href="../css/custom.css">
    <title><?= $nav_title ?></title>
</head>

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top zindex-fixed navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand row" href="#">
                    <h2><?= $site_title ?><span> |</span></h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item navbar-brand">
                            <p class="nav_title"><?= $nav_title ?></p>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                user_name
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
        <div class="mt-5 container-fluid">
            <div class="row">
                <div class="col-1 col-md-2 col-xl-3"></div>
                <div class="mb-4 col-10 col-md-8 col-xl-6">
                    <a href="#"><button type="button" class="me-5 btn btn-primary">ログイン</button></a>
                    <a href="#"><button type="button" class="btn btn-success">新規登録</button></a>
                </div>
                <div class="col-1 col-md-2 col-xl-3"></div>

                <div class="col-1 col-md-2 col-xl-3"></div>
                <div class="col-10 col-md-8 col-xl-6">


                    <div class="card">
                        <h5 class="card-header">使い方</h5>
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


                    <div class="card">
                        <h5 class="card-header">なぜなに「koto-koto」</h5>
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>



                    <p>Hallo world</p>
                    <p>linux環境を一旦削除、その後復元</p>
                    <p>Githubとの連携が出来ているかチェック</p>
                    <p>ubuntuにcloneした、プッシュのテスト</p>
                    <p>bootstrapのデフォルトの色を変更したい…</p>
                    <p>中心に寄り過ぎだなぁ</p>
                </div>
                <div class="col-1 col-md-2 col-xl-3"></div>
            </div>
        </div>
    </main>
    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>