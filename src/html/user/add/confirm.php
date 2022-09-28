<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';

// セッションスタート
Security::session();

// インスタンス作成
$ins = new Base();

// actionページから戻ってきた場合は、トークンの確認を素通りさせる
if (isset($_SESSION['verified']['action']) == true && $_SESSION['verified']['action'] != 'OK') {
    // トークンの確認
    if (Security::matchedToken($_POST['token'], $_SESSION['token']) == false) {
        header('Location:../../error/index.php');
        exit('トークンが一致しません');
    }
}

// トークンの確認の素通りを解除する
if (isset($_SESSION['verified']['action']) == 'OK') {
    unset($_SESSION['verified']['action']);
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

// チェックのどこかでNGがあった場合、入力画面にリダイレクトする。HTTPコード307はPOSTデータを引き継いでリダイレクトする
if ($has_err == true) {
    $_SESSION['verified']['confirm'] = 'OK';
    header('location:./index.php', true, 307);
    exit('バリデーションNGです');
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

<body class="bg-light mt-5 mb-5">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 bg-opacity-75 navbar-expand-md navbar-dark bg-dark">
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
            <form action="./action.php" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                <fieldset disabled>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 mb-4">
                            <p>登録内容を入力してください</p>
                        </div>
                        <div class="col-md-8 mb-2">
                            <label for="user_name" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="user_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['user_name'] : '' ?>>
                        </div>
                        <div class="col-md-8 mb-2">
                            <label for="family_name" class="form-label">姓</label>
                            <input type="text" class="form-control" name="family_name" id="family_name" placeholder="family_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['family_name'] : '' ?>>
                        </div>
                        <div class="col-md-8 mb-2">
                            <label for="first_name" class="form-label">名</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['first_name'] : '' ?>>
                        </div>
                        <div class="col-md-8">
                            <label for="" class="form-label">生年月日</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-select" name="birth_date_year" id="birth_date_year">
                                    <option value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_year'] : '' ?>><?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_year'] : '' ?></option>
                                    <?php for ($i = $ins->this_year; $i >= $ins->this_year - 100; $i--) : ?>
                                        <option value=<?= $i ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                <label class="input-group-text" for="birth_date_year">年</label>
                            </div>
                        </div>
                        <div class="row p-0 mb-2 justify-content-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select class="form-select" name="birth_date_month" id="birth_date_month">
                                        <option value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_month'] : '' ?>><?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['birth_date_month'] : '' ?></option>
                                        <?php foreach (Config::MONTHS as $key => $val) : ?>
                                            <option value=<?= $val ?>><?= $val ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label class="input-group-text" for="birth_date_month">月</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
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
                        <div class="col-md-8 mb-2">
                            <label for="user_mail_address" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" name="user_mail_address" id="user_mail_address" placeholder="your@example.com" value=<?= isset($_SESSION['input_user_data']) ? $_SESSION['input_user_data']['user_mail_address'] : '' ?>>
                        </div>
                    </div>
                </fieldset>

                <!-- ボタン -->
                <div class="row d-flex justify-content-center">
                    <div class="mt-4 col-md-8">
                        <button type="submit" class="btn btn-success">登録</button>
                        <a href="./index.php"><input type="button" class="btn btn-secondary" value="前のページ戻る"></a>
                        <a href="./cancel.php"><input type="button" class="btn btn-danger" value="キャンセル"></a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>