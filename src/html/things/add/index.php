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

// 現在の日付を取得 $date->format('Y/n/d'); // 2016/1/25
// 現在の日付を取得 $date->format('Y/m/d'); // 2016/01/25
$date = new DateTime();
// フォーマットを整えて変数に代入
$today = $date->format('Y/m/d');


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
            <div class="navbar-text container-fluid">
                <a class="navbar-brand" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0 d-flex justify-content-start">
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

                    <!-- 年月日の入力フォーム -->
                    <form class="invisible row" action="#">
                        <div class="col input-group">
                            <select class="form-select" name="input_year" id="input_year">
                                <?php for ($i = Config::FIRST_YEAR; $i <= $ins->this_year; $i++) : ?>
                                    <option value="$i"><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                            <label class="input-group-text" for="input_year">年</label>
                        </div>
                        <div class="col input-group">
                            <select class="form-select" name="input_month" id="input_month">
                                <?php foreach (Config::MONTHS as $key => $val) : ?>
                                    <option value=<?= $val ?>><?= $val ?></option>
                                <?php endforeach ?>
                            </select>
                            <label class="input-group-text" for="input_month">月</label>
                        </div>
                        <div class="col input-group">
                            <select class="form-select" name="input_day" id="input_day">
                                <?php foreach (Config::DAYS as $key => $val) : ?>
                                    <option value=<?= $val ?>><?= $val ?></option>
                                <?php endforeach ?>
                            </select>
                            <label class="input-group-text" for="input_day">日</label>
                        </div>
                    </form>

                    <!-- ユーザメニュー -->
                    <ul class="navbar-nav mb-lg-0 d-flex justify-content-end">
                        <li class="nav-item dropstart">
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
                    <!-- ここまでドロップダウンメニュー -->
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-5 container">
            <div class="row justify-content:flex-start">
                <div class="col-sm">
                    <h2 class="right_bg_line"><?= $today ?></h2>
                </div>
            </div>

            <!-- デキゴト入力ブロック -->
            <form action="./action.php" method="post">
                <div class="row mt-4 justify-content-end">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <label class="form-label" for="thing">デキゴトの登録
                            <textarea class="form-control" name="thing" id="thing" cols="80" rows="5" maxlength="200" placeholder="デキゴトを入力してください"><?= empty($_SESSION['post_data']['thing']) ? '' : $_SESSION['post_data']['thing'] ?></textarea>
                            <div class="form-text"><?= Config::TIPS_LL_THING ?></div>
                        </label>
                    </div>
                    <div class="col-sm"></div>
                </div>

                <!-- thingの文字数エラーメッセージ -->
                <div class="row justify-content-start">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llThing']) ? $_SESSION['err']['err_llThing'] : '' ?>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>

                <!-- 属性付与ブロック -->
                <div class="row mt-4 justify-content-start">
                    <div class="col-sm-2"></div>

                    <!-- イイコトブロック -->
                    <!-- <div class="col-sm-auto align-self-center">
                        <input class="form-check-input" type="checkbox" name="good_thing_flag" id="good_thing_flag" onclick="goodThingRankDisabled('good_thing_rank',this.checked)" value="1">
                        <label class="form-check-label" for="good_thing_flag">イイコト</label>
                    </div> -->
                    <div class="col-sm-auto align-self-center">
                        <div class="input-group">
                            <label class="input-group-text" for="good_thing_rank">イイコトランク</label>
                            <select class="level form-select" name="good_thing_rank" id="good_thing_rank">
                                <?php foreach (Config::GOOD_THING_RANK as $i) : ?>
                                    <option value=<?= $i ?>><?= $i ?>位</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- ヤナコトブロック -->
                    <!-- <div class="col-sm-auto align-self-center">
                        <input class="form-check-input" type="checkbox" name="bad_thing_flag" id="bad_thing_flag" onclick="badFactorDisabled(this.checked)" value="1">
                        <label class="form-check-label" for="bad_thing_flag">ヤナコト</label>
                    </div> -->
                    <div class="col-sm-auto align-self-center">
                        <div class="input-group">
                            <label class="input-group-text" for="bad_thing_level">ヤナコトレベル</label>
                            <select class="bad_factor level form-select" name="bad_thing_level" id="bad_thing_level">
                                <?php foreach (Config::BAD_THING_LEVEL as $i) : ?>
                                    <option value=<?= $i ?>><?= $i ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>

                <!-- 対処法の記入ブロック -->
                <div class="row mt-4 justify-content-end">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <label class="form-label" for="bad_thing_approach">ヤナコトの対処法
                            <textarea class="bad_factor form-control" name="bad_thing_approach" id="bad_thing_approach" cols="80" rows="5" maxlength="1000" placeholder="対処法を入力"><?= empty($_SESSION['post_data']['bad_thing_approach']) ? '' : $_SESSION['post_data']['bad_thing_approach'] ?></textarea>
                            <div class="form-text"><?= Config::TIPS_LL_APPROACH ?></div>
                        </label>
                    </div>
                    <div class="col-sm"></div>
                </div>

                <!-- 対処法の文字数エラーメッセージ -->
                <div class="row justify-content-start">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llApproach']) ? $_SESSION['err']['err_llApproach'] : '' ?>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>

                <!-- 送信ボタンたち -->
                <div class="row justify-content-start">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <button class="me-3 btn btn-primary" type="submit">登録する</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href='./index.php',this.clicked">書き直す</button>
                    </div>
                    <div class="col-sm"></div>
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
    <script src="../../../js/script.js"></script>

</body>

</html>