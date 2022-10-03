<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';
require_once '../../../class/DB_Things.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

// 戻ってきた場合は、トークンの確認を素通りさせる
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

$ins = new Base;
$DBins = new DB_Things;
$get_id = $_GET['id'];

try {
    $thing = $DBins->thingSelect($get_id, $_SESSION['login_user']['id']);
    if ($thing == false) {
        throw new Exception('レコードが取得できませんでした');
    }
} catch (Exception $e) {
    $_SESSION['exception'] = $e;
    header('Location:' . $ins->err_page_url);
    exit();
}

$_SESSION['thing'] = $thing;

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
    <title>デキゴトを編集</title>
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
                        <h4>デキゴトを編集</h4>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row justify-content:flex-start">
                <div class="col-sm">
                    <p>デキゴトを編集してください</p>
                </div>
            </div>
            <div class="row justify-content:flex-start">
                <div class="col-sm">
                    <h2 class="right_bg_line"><?= mb_substr(str_replace('-', '/', $thing['create_date_time']), 0, 16) ?></h2>
                </div>
            </div>

            <!-- デキゴト入力ブロック -->
            <form action="./action.php" method="post">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="hidden" name="get_id" value="<?= $get_id ?>">
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <label class="form-label" for="thing">デキゴト
                            <textarea class="form-control" name="thing" id="thing" cols="80" rows="5" maxlength="200"><?= $thing['thing'] ?></textarea>
                            <div class="form-text"><?= Config::TIPS_LL_THING ?></div>
                        </label>
                    </div>
                </div>

                <!-- デキゴトの文字数エラーメッセージ -->
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llThing']) ? $_SESSION['err']['err_llThing'] : '' ?>
                        </div>
                    </div>
                </div>

                <!-- 属性付与ブロック -->
                <div class="row">

                    <!-- イイコトブロック -->
                    <div class="d-lg-flex col-md-7 offset-md-2">
                        <div class="input-group">
                            <label class="input-group-text" for="good_thing_rank">イイコトランク</label>
                            <select class="level form-select" name="good_thing_rank" id="good_thing_rank">
                                <option value="<?= $thing['good_thing_rank'] ?>"><?= $thing['good_thing_rank'] ?>位</option>
                                <?php foreach (Config::GOOD_THING_RANK as $i) : ?>
                                    <option value="<?= $i ?>"><?= $i ?>位</option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <!-- ヤナコトブロック -->
                        <div class="input-group">
                            <label class="input-group-text" for="bad_thing_level">ヤナコトレベル</label>
                            <select class="bad_factor level form-select" name="bad_thing_level" id="bad_thing_level">
                                <option value="<?= $thing['bad_thing_level'] ?>"><?= $thing['bad_thing_level'] ?></option>
                                <?php foreach (Config::BAD_THING_LEVEL as $i) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 対処法の記入ブロック -->
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <label class="form-label" for="bad_thing_approach">ヤナコトの対処法
                            <textarea class="bad_factor form-control" name="bad_thing_approach" id="bad_thing_approach" cols="80" rows="5" maxlength="1000"><?= empty($thing['bad_thing_approach']) ? '' : $thing['bad_thing_approach'] ?></textarea>
                            <div class="form-text"><?= Config::TIPS_LL_APPROACH ?></div>
                        </label>
                    </div>
                </div>

                <!-- 対処法の文字数エラーメッセージ -->
                <div class="row justify-content-start">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llApproach']) ? $_SESSION['err']['err_llApproach'] : '' ?>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタンたち -->
                <div class="row justify-content-start">
                    <div class="col-md-8 offset-md-2">
                        <button class="me-3 btn btn-primary" type="submit">編集を登録</button>
                        <a href="./cancel.php"><input type="button" class="btn btn-danger" value="キャンセル"></a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/script.js"></script>

</body>

</html>