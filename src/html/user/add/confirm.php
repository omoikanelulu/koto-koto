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

// POSTされてきたデータをサニタイズして$postへ代入
$post = Security::sanitize($_POST);

// サニタイズ済みのデータをセッションに保存
$_SESSION['input_user_data'] = $post;

// 【バリデーション開始】
$has_err = '';
$result = '';
unset($_SESSION['err']);

// user_nameの文字数チェック
$result = Validation::llUserName($post['user_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_name'] = Config::ERR_LL_USER_NAME;
    $has_err = true;
} else {
    $result = '';
}

// family_nameの文字数チェック
$result = Validation::llFamilyName($post['family_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_family_name'] = Config::ERR_LL_FAMILY_NAME;
    $has_err = true;
} else {
    $result = '';
}

// first_nameの文字数チェック
$result = Validation::llFirstName($post['first_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_first_name'] = Config::ERR_LL_FIRST_NAME;
    $has_err = true;
} else {
    $result = '';
}

// user_mail_addressの文字数チェック
$result = Validation::llUserMailAddress($post['user_mail_address']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_mail_address'] = Config::ERR_LL_USER_MAIL_ADDRESS;
    $has_err = true;
} else {
    $result = '';
}

// passの文字数チェック
$result = Validation::llPass($post['pass']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_pass'] = Config::ERR_LL_PASS;
    $has_err = true;
} else {
    $result = '';
}

// 生年月日が正しいかチェック
$result = Validation::isCorrectDate($post['birth_date_year'], $post['birth_date_month'], $post['birth_date_day']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_correct_date'] = Config::ERR_IS_CORRECT_DATE;
    $has_err = true;
} else {
    $result = '';
}

// 確認用メールアドレスが正しいかチェック
$result = Validation::isMatched($post['user_mail_address'], $post['user_mail_address_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_mail'] = Config::ERR_IS_MATCHED;
    $has_err = true;
} else {
    $result = '';
}

// 確認用パスワードが正しいかチェック
$result = Validation::isMatched($post['pass'], $post['pass_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_pass'] = Config::ERR_IS_MATCHED;
    $has_err = true;
} else {
    $result = '';
}
// 【バリデーション終了】

// チェックのどこかでNGがあった場合、入力画面にリダイレクトする。HTTPコード307でトークンも送信出来る？
if ($has_err == true) {
    header('location:./index.php', true, 307);
    exit();
}

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
            <form action="./action.php" method="POST">
                <fieldset disabled>
                    <input type="hidden" name="token" value="<?= $token ?>">
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
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
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
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
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
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
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
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
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
                        <a href="./cancel.php"><button type="button" class="btn btn-danger">キャンセル</button></a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>

        <?php
        // デバッグ用 //
        echo '<pre>$_POST_token';
        var_dump($_POST['token']);
        echo '</pre>';
        echo '<pre>$token';
        var_dump($token);
        echo '</pre>';
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