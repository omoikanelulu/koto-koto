<?php

use LDAP\Result;

require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';

// セッションスタート
Security::session();

// インスタンス作成
$ins = new Base();

// POSTされてきたデータをサニタイズして$postへ代入
$post = Security::sanitize($_POST);

// サニタイズ済みのデータをセッションに保存
$_SESSION['input_user_data'] = $post;

// 【バリデーション開始】
$result = "";
unset($_SESSION['err']);

// user_nameの文字数チェック
$result = Validation::ll_user_name($post['user_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_name'] = Config::$err_ll_user_name;
} else {
    $result = '';
}

// family_nameの文字数チェック
$result = Validation::ll_family_name($post['family_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_family_name'] = Config::$err_ll_family_name;
} else {
    $result = '';
}

// user_mail_addressの文字数チェック
$result = Validation::ll_user_mail_address($post['user_mail_address']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_mail_address'] = Config::$err_ll_user_mail_address;
} else {
    $result = '';
}

// passの文字数チェック
$result = Validation::ll_pass($post['pass']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_pass'] = Config::$err_ll_pass;
} else {
    $result = '';
}

// first_nameの文字数チェック
$result = Validation::ll_first_name($post['first_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_first_name'] = Config::$err_ll_first_name;
} else {
    $result = '';
}

// 生年月日が正しいかチェック
$result = Validation::is_correct_date($post['birth_date_year'], $post['birth_date_month'], $post['birth_date_day']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_correct_date'] = Config::$err_is_correct_date;
} else {
    $result = '';
}

// 確認用メールアドレスが正しいかチェック
$result = Validation::is_matched($post['user_mail_address'], $post['user_mail_address_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_mail'] = Config::$err_is_matched;
} else {
    $result = '';
}

// 確認用パスワードが正しいかチェック
$result = Validation::is_matched($post['pass'], $post['pass_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_pass'] = Config::$err_is_matched;
} else {
    $result = '';
}
// 【バリデーション終了】

// デバッグ用 //
echo '<pre>';
var_dump($result);
var_dump($post);
echo '</pre>';
exit();
////////////////
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
                    <h1><?= Config::$site_title ?> |</h1>
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
            <form action="./action.php" method="POST">
                <fieldset disabled>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col mb-4">
                            <p>以下の内容で登録します、</p>
                            <p>よろしいですか？</p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" id="user_name" value=<?= $post['user_name'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="family_name" class="form-label">姓</label>
                            <input type="text" class="form-control" id="family_name" value=<?= $post['family_name'] ?>>
                        </div>
                        <div class="col">
                            <label for="first_name" class="form-label">名</label>
                            <input type="text" class="form-control" id="first_name" value=<?= $post['first_name'] ?>>
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
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="" class="form-label">生年月日</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="birth_date_year">
                                    <option selected><?= $post['birth_date_year'] ?></option>
                                </select>
                                <label class="input-group-text" for="birth_date_year">年</label>
                            </div>
                        </div>
                        <div class="me-2 row row-cols-2 d-flex justify-content-center align-items-end">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select class="form-select" id="birth_date_month">
                                        <option selected><?= $post['birth_date_month'] ?></option>
                                    </select>
                                    <label class="input-group-text" for="birth_date_month">月</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select class="form-select" id="birth_date_day">
                                        <option selected><?= $post['birth_date_day'] ?></option>
                                    </select>
                                    <label class="input-group-text" for="birth_date_day">日</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="user_mail_address" value=<?= $post['user_mail_address'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" id="pass" value=<?= $post['pass'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            NG message
                        </div>
                        <div class="col"></div>
                    </div>
                </fieldset>
                <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                    <div class="col">
                        <button type="submit" class="me-3 btn btn-success">新規登録</button>
                        <a href="./index.php"><button type="button" class="btn btn-secondary">前のページに戻る</button></a>
                    </div>
                    <div class="col">
                        <a href=<?= $ins->top_page_url ?>><button type="button" class="btn btn-danger">キャンセル</button></a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
    </footer>

    <!-- 指定したidがついている要素にreadonlyを付与するっぽいけど動かなかった
    <script>
        $('#user_form *').prop('readonly', true);
    </script> -->

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>