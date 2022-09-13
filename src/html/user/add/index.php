<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';

// セッションスタート
Security::session();

// インスタンス作成
$ins = new Base();

// トークンの確認
if (Security::matchedToken($_POST['token']) == false) {
    header('Location:../../error/index.php');
    exit('トークンが一致しません');
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
            <form action="./confirm.php" method="POST">
                <fieldset>
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <p class="mb-4">登録内容を入力してください</p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="user_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['user_name'] : '' ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_ll_user_name'])) : ?>
                                <?= $_SESSION['err']['err_ll_user_name'] ?>
                            <?php endif ?>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="family_name" class="form-label">姓</label>
                            <input type="text" class="form-control" name="family_name" id="family_name" placeholder="family_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['family_name'] : '' ?>>
                        </div>
                        <div class="col">
                            <label for="first_name" class="form-label">名</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['first_name'] : '' ?>>
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_ll_family_name'])) : ?>
                                <?= $_SESSION['err']['err_ll_family_name'] ?>
                            <?php endif ?>
                        </div>
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_ll_first_name'])) : ?>
                                <?= $_SESSION['err']['err_ll_first_name'] ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="" class="form-label">生年月日</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="birth_date_year" id="birth_date_year">
                                    <option value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_year'] : '' ?>><?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_year'] : '' ?></option>
                                    <?php for ($i = $ins->this_year; $i >= $ins->this_year - 100; $i--) : ?>
                                        <option value=<?= $i ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                <label class="input-group-text" for="birth_date_year">年</label>
                            </div>
                        </div>
                        <div class="me-2 row row-cols-2 d-flex justify-content-center align-items-end">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="birth_date_month" id="birth_date_month">
                                        <option value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_month'] : '' ?>><?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_month'] : '' ?></option>
                                        <?php foreach (Config::MONTHS as $key => $val) : ?>
                                            <option value=<?= $val ?>><?= $val ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label class="input-group-text" for="birth_date_month">月</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="birth_date_day" id="birth_date_day">
                                        <option value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_day'] : '' ?>><?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_day'] : '' ?></option>
                                        <?php foreach (Config::DAYS as $key => $val) : ?>
                                            <option value=<?= $val ?>><?= $val ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label class="input-group-text" for="birth_date_day">日</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_is_correct_date'])) : ?>
                                <?= $_SESSION['err']['err_is_correct_date'] ?>
                            <?php endif ?>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" name="user_mail_address" id="user_mail_address" placeholder="your@example.com" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['user_mail_address'] : '' ?>>
                        </div>
                        <div class="col">
                            <label for="user_mail_address_check" class="form-label">メールアドレス確認用</label>
                            <input type="email" class="form-control" name="user_mail_address_check" id="user_mail_address_check" placeholder="再入力">
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_ll_user_mail_address'])) : ?>
                                <?= $_SESSION['err']['err_ll_user_mail_address'] ?>
                            <?php endif ?>
                        </div>
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_is_matched_mail'])) : ?>
                                <?= $_SESSION['err']['err_is_matched_mail'] ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="your_password">
                        </div>
                        <div class="col">
                            <label for="pass_check" class="form-label">パスワード確認用</label>
                            <input type="password" class="form-control" name="pass_check" id="pass_check" placeholder="再入力">
                        </div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_ll_pass'])) : ?>
                                <?= $_SESSION['err']['err_ll_pass'] ?>
                            <?php endif ?>
                        </div>
                        <div class="col form-text text-danger">
                            <?php if (isset($_SESSION['err']['err_is_matched_pass'])) : ?>
                                <?= $_SESSION['err']['err_is_matched_pass'] ?>
                            <?php endif ?>
                        </div>
                    </div>
                </fieldset>
                <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                    <div class="col">
                        <button type="submit" class="me-3 btn btn-success">新規登録</button>
                        <a href="./cancel.php"><input type="button" class="btn btn-danger" value="キャンセル"></a>
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
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>