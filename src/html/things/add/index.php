<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';
require_once '../../../class/DB_Base.php';

Security::session();

// ログインしていない場合トップページへリダイレクトする
Security::notLogin();

$ins = new Base();

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

// 現在の日付を取得 $date->format('Y/n/d'); // 2016/1/25
// 現在の日付を取得 $date->format('Y/m/d'); // 2016/01/25
$date = new DateTime();
// フォーマットを整えて変数に代入
$today = $date->format('Y/m/d');

// 今月の1日に設定
$this_month = $date->format('Y-m-01');

if (isset($_POST['search_date']) == false) {
    $search_date = $this_month;
} else {
    $search_date = $_POST['search_date'];
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

<body class="bg-light mt-5 mb-5">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 bg-opacity-75 navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-text container-fluid">
                <a class="navbar-brand" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-inline">
                        <!-- ここからドロップダウンメニュー -->
                        <!-- ページ移動メニュー -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $ins->nav_title ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <?php foreach ($ins->nav_menus['links'] as $menu => $url) : ?>
                                    <li><a class="dropdown-item" href="<?= $url ?>"><?= $menu ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>

                    <!-- ユーザメニュー -->
                    <ul class="navbar-nav d-inline">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= isset($_SESSION['login_user']['user_name']) ? $_SESSION['login_user']['user_name'] : '' ?>
                            </a>
                            <ul class="text-start dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <?php foreach ($ins->nav_user_menus as $menu => $url) : ?>
                                    <li><a class="dropdown-item" href=<?= $url ?>><?= $menu ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>

                    <!-- 年月日の入力フォーム -->
                    <form class="d-none row me-auto d-flex justify-content-start" id="search_date_form" action="#" method="post">
                        <div class="navbar-nav mb-lg-0">
                            <div class="col-sm input-group">
                                <input type="date" name="search_date" id="search_date_input" pattern=”[0-9]{4}-[0-9]{2}-[0-9]{2}” value=<?= $search_date ?>>
                                <i class="bi bi-calendar" id="search_date_icon"></i>
                            </div>
                            <div class="col-sm input-group">
                                <input class="btn" type="submit" id="search_date_submit" value="以降を表示">
                            </div>
                        </div>
                    </form>
                    <!-- ここまでドロップダウンメニュー -->
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row justify-content:flex-start">
                <div class="col-sm">
                    <h2 class="right_bg_line"><?= $today ?></h2>
                </div>
            </div>

            <!-- デキゴト入力ブロック -->
            <form action="./action.php" method="post">
                <input type="hidden" name="token" value="<?= $token ?>">
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <label class="form-label" for="thing">デキゴトの登録
                            <textarea class="form-control" name="thing" id="thing" cols="80" rows="5" maxlength="200" placeholder="デキゴトを入力してください"><?= empty($_SESSION['post_data']['thing']) ? '' : $_SESSION['post_data']['thing'] ?></textarea>
                            <div class="form-text"><?= Config::TIPS_LL_THING ?></div>
                        </label>
                    </div>
                </div>

                <!-- thingの文字数エラーメッセージ -->
                <div class="row justify-content-start">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llThing']) ? $_SESSION['err']['err_llThing'] : '' ?>
                        </div>
                    </div>
                </div>

                <!-- 属性付与ブロック -->
                <div class="row mt-4">

                    <!-- イイコトブロック -->
                    <div class="d-lg-flex col-md-7 offset-md-2">
                        <div class="input-group">
                            <label class="input-group-text" for="good_thing_rank">イイコトランク</label>
                            <select class="level form-select" name="good_thing_rank" id="good_thing_rank">
                                <?php foreach (Config::GOOD_THING_RANK as $i) : ?>
                                    <option value=<?= $i ?>><?= $i ?>位</option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <!-- ヤナコトブロック -->
                        <div class="input-group">
                            <label class="input-group-text" for="bad_thing_level">ヤナコトレベル</label>
                            <select class="bad_factor level form-select" name="bad_thing_level" id="bad_thing_level">
                                <?php foreach (Config::BAD_THING_LEVEL as $i) : ?>
                                    <option value=<?= $i ?>><?= $i ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 対処法の記入ブロック -->
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <label class="form-label" for="bad_thing_approach">ヤナコトの対処法
                            <textarea class="bad_factor form-control" name="bad_thing_approach" id="bad_thing_approach" cols="80" rows="5" maxlength="1000" placeholder="対処法を入力"><?= empty($_SESSION['post_data']['bad_thing_approach']) ? '' : $_SESSION['post_data']['bad_thing_approach'] ?></textarea>
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
                        <button class="me-3 btn btn-primary" type="submit">登録する</button>
                        <a href="./cancel.php"><input type="button" class="btn btn-danger" value="キャンセル"></a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php
        // デバッグ用 //
        // echo '<pre>';
        // var_dump($_SESSION);
        // echo '</pre>';
        ////////////////
        ?>
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/script.js"></script>

</body>

</html>