<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Users.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

$ins = new Base();

// POSTされてきたデータをサニタイズして$postへ代入
$post = Security::sanitize($_POST);

// サニタイズ済みのデータをセッションに保存
$_SESSION['input_user_data'] = $post;

// checkId()を通過した事を示す値を持たせる
$_SESSION['verified'] = 'checkId';

// 【バリデーション開始】
$check_ng = '';
$result = '';
unset($_SESSION['err']);

// user_nameの文字数チェック
$result = Validation::llUserName($post['user_name']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_name'] = Config::ERR_LL_USER_NAME;
    $check_ng = true;
} else {
    $result = '';
}

// user_mail_addressの文字数チェック
$result = Validation::llUserMailAddress($post['user_mail_address']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_user_mail_address'] = Config::ERR_LL_USER_MAIL_ADDRESS;
    $check_ng = true;
} else {
    $result = '';
}

// passの文字数チェック
$result = Validation::llPass($post['pass']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_ll_pass'] = Config::ERR_LL_PASS;
    $check_ng = true;
} else {
    $result = '';
}

// 確認用メールアドレスが正しいかチェック
$result = Validation::isMatched($post['user_mail_address'], $post['user_mail_address_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_mail'] = Config::ERR_IS_MATCHED;
    $check_ng = true;
} else {
    $result = '';
}

// 確認用パスワードが正しいかチェック
$result = Validation::isMatched($post['pass'], $post['pass_check']);
if ($result == false) { // NGの場合
    $_SESSION['err']['err_is_matched_pass'] = Config::ERR_IS_MATCHED;
    $check_ng = true;
} else {
    $result = '';
}
// 【バリデーション終了】

// チェックのどこかでNGがあった場合、入力画面にリダイレクトする。HTTPコード307でトークンも送信出来る？
if ($check_ng == true) {
    header('location:./account_edit.php', true, 307);
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
    <link rel="stylesheet" href="../../../css/bootstrap5.1.3/dist/css/bootstrap.min.css">
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
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <p class="mb-4">下記の内容で編集してよろしいですか？</p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <input type="checkbox" name="user_name_edit" id="user_name">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" value=<?= $post['user_name'] ?>>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_user_name']) ? $_SESSION['err']['err_ll_user_name'] : '' ?>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <input type="checkbox" name="user_mail_address_edit" id="user_mail_address">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" name="user_mail_address" id="user_mail_address" value=<?= $post['user_mail_address'] ?>>
                        </div>
                        <div class="col">
                            <label for="user_mail_address_check" class="form-label">メールアドレス確認用</label>
                            <input type="email" class="form-control" name="user_mail_address_check" id="user_mail_address_check" placeholder="hoge@example.com">
                        </div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_user_mail_address']) ? $_SESSION['err']['err_ll_user_mail_address'] : '' ?>
                        </div>
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_is_matched_user_mail_address']) ? $_SESSION['err']['err_is_matched_user_mail_address'] : '' ?>
                        </div>
                    </div>
                    <div class="row row-cols-3 d-flex justify-content-center">
                        <div class="col">
                            <input type="checkbox" name="pass_edit" id="pass">
                            <label for="pass" class="form-label">パスワード</label>
                            <input type="password" class="form-control" name="pass" id="pass" value=<?= $post['pass'] ?>>
                        </div>
                        <div class="col">
                            <label for="pass_check" class="form-label">パスワード確認用</label>
                            <input type="password" class="form-control" name="pass_check" id="pass_check" placeholder="your_password">
                        </div>
                    </div>
                    <div class="invisible mb-4 row row-cols-3 d-flex justify-content-center">
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_ll_pass']) ? $_SESSION['err']['err_ll_pass'] : '' ?>
                        </div>
                        <div class="col form-text text-danger">
                            <?= isset($_SESSION['err']['err_is_matched_pass']) ? $_SESSION['err']['err_is_matched_pass'] : '' ?>
                        </div>
                    </div>
                </fieldset>
                <div class="mb-4 row row-cols-3 d-flex justify-content-center">
                    <div class="col">
                        <button type="submit" class="me-3 btn btn-success">編集する</button>
                        <a href="./account_edit.php"><button type="button" class="me-3 btn btn-secondary">前の画面に戻る</button></a>
                    </div>
                    <div class="col">
                        <a href="<?= $ins->things_top_page_url ?>"><button type="button" class="btn btn-danger">キャンセル</button></a>
                    </div>
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
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>