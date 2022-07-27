<?php
$site_title = 'koto-koto';
$nav_title = '新規登録';

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
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-5 container">
            <p class="mb-4">登録内容を入力してください</p>
            <div class="row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <label for="user_mail_address" class="form-label">ユーザ名</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
            </div>
            <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                <div class="col form-text text-danger">
                    NG message
                </div>
            </div>
            <div class="row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <label for="user_mail_address" class="form-label">姓</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
                <div class="col">
                    <label for="user_mail_address" class="form-label">名</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
            </div>
            <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                <div class="col form-text text-danger">
                    NG message
                </div>
                <div class="col form-text text-danger">
                    NG message
                </div>
            </div>

            <label for="user_mail_address" class="form-label">生年月日</label>
            <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <div class="input-group mb-3">
                        <select class="form-select" id="inputGroupSelect02">
                            <option selected>2022</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect02">年</label>
                    </div>
                </div>
                <div class="row row-cols-2 d-flex justify-content-center">
                    <div class="col">
                        <div class="input-group mb-3">
                            <select class="form-select" id="inputGroupSelect02">
                                <option selected>01</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                            </select>
                            <label class="input-group-text" for="inputGroupSelect02">月</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <select class="form-select" id="inputGroupSelect02">
                                <option selected>01</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                            </select>
                            <label class="input-group-text" for="inputGroupSelect02">日</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <label for="user_mail_address" class="form-label">メールアドレス</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
                <div class="col">
                    <label for="user_mail_address" class="form-label">メールアドレス確認用</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
            </div>
            <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                <div class="col form-text text-danger">
                    NG message
                </div>
                <div class="col form-text text-danger">
                    NG message
                </div>
            </div>
            <div class="row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <label for="user_mail_address" class="form-label">パスワード</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
                <div class="col">
                    <label for="user_mail_address" class="form-label">パスワード確認用</label>
                    <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                </div>
            </div>
            <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                <div class="col form-text text-danger">
                    NG message
                </div>
                <div class="col form-text text-danger">
                    NG message
                </div>
            </div>
            <div class="row row-cols-3 d-flex justify-content-center">
                <div class="col">
                    <button type="submit" class="me-3 btn btn-success">登録</button>
                    <button type="reset" class="btn btn-danger">キャンセル</button>
                </div>
            </div>
            <p>このキャンセルボタンはtype属性が多分間違ってる</p>
        </div>
    </main>
    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>