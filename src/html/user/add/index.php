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
    <!-- <link rel="stylesheet" href="../css/bootstrap5.1.3/dist/css/bootstrap.min.css"> -->
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
        <div class="mt-5 container-fluid">
            <div class="row">
                <div class="col-1 col-md-2 col-xl-3"></div>

                <div class="mb-4 col-10 col-md-8 col-xl-6">
                    <form>





                        <div class="row">
                            <div class="mb-4 col-5 col-md-4 col-xl-3">
                                <label for="user_name" class="form-label">ユーザ名</label>
                                <input type="text" class="form-control" id="user_name" placeholder="user_name">
                            </div>
                        </div>












                        <div class="row">
                            <div class="mb-4 col-5 col-md-4 col-xl-3">
                                <label for="user_mail_address" class="form-label">メールアドレス</label>
                                <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                            </div>
                            <div class="mb-4 col-5 col-md-4 col-xl-3">
                                <label for="user_mail_address" class="form-label">メールアドレス確認用</label>
                                <input type="email" class="form-control" id="user_mail_address" placeholder="hoge@example.com">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-5 col-md-4 col-xl-3">
                                <label for="exampleFormControlTextarea1" class="form-label">パスワード</label>
                                <input type="password" class="form-control" name="pass" id="pass">
                            </div>
                            <div class="mb-4 col-5 col-md-4 col-xl-3">
                                <label for="exampleFormControlTextarea1" class="form-label">パスワード確認用</label>
                                <input type="password" class="form-control" name="pass" id="pass">
                            </div>
                        </div>
                        <div class="mb-4 form-text text-danger">
                            NG message
                        </div>
                        <div>
                            <button type="submit" class="me-3 btn btn-primary">ログイン</button>
                            <button type="reset" class="btn btn-danger">キャンセル</button>
                            <p>このキャンセルボタンはtype属性が多分間違ってる</p>
                        </div>
                    </form>
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