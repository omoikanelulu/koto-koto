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

$ins = new Base;
$DBins = new DB_Things;

$things = $DBins->thingShow($_SESSION['login_user']['id']);

// デバッグ用 //
// echo '<pre>';
// var_dump($things);
// echo '</pre>';
// exit();
////////////////

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cssの読み込み -->
    <link rel="stylesheet" href="../../../css/bootstrap5.1.3/dist/css/bootstrap.min.css">
    <!-- bootstrap-iconの読み込み -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- 自作cssの読み込み -->
    <link rel="stylesheet" href="../../../css/custom.css">
    <title><?= $ins->nav_title ?></title>
</head>

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top zindex-fixed p-0 opacity-75 navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-text container-fluid align-item-center">
                <a class="navbar-brand" href="<?= $ins->top_page_url ?>">
                    <h1><?= Config::SITE_TITLE ?> |</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0">
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
                        <!-- 年月日の入力フォーム -->
                        <form class="row" action="#">
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
                    </ul>
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
                    <?php foreach ($things as $thing) : ?>
                        <!-- 日付を表示 -->
                        <!-- str_replace('変更したい文字列', '変更後の文字列', 置換対象 -->
                        <!-- mb_substr(文字列,取り出したい文字の開始位置,開始位置から取り出す文字の数) -->
                        <h2 class="right_bg_line"><?= mb_substr(str_replace('-', '/', $thing['create_date_time']), 0, 16) ?></h2>

                        <!-- イイコトの順位表示 -->
                        <div class="row m-2 mb-4 justify-content-start align-items-center">
                            <div class="col-sm-1 text-center">
                                <p class="mb-0 bg-good-thing rounded-pill"><?= empty($thing['good_thing_rank']) ? '' : $thing['good_thing_rank'] ?></p>
                            </div>

                            <!-- ヤナコトの強度表示 -->
                            <div class="col-sm-1 text-center">
                                <p class="mb-0 bg-bad-thing rounded-pill"><?= empty($thing['bad_thing_level']) ? '' : $thing['bad_thing_level'] ?></p>
                            </div>

                            <!-- thingを表示 -->
                            <div class="col-sm-8">
                                <p class="mb-0"><?= $thing['thing'] ?></p>
                            </div>

                            <!-- 各種ボタンを表示 -->
                            <div class="col-sm-1 text-center">
                                <a href="../edit/index.php?id=<?= urlencode($thing['id']) ?>"><i class="bi bi-pencil">編集</i></a>
                            </div>
                            <div class="col-sm-1 text-center">
                                <a href="../delete/action.php?id=<?= urlencode($thing['id']) ?>"><i class="bi bi-trash">削除</i></a>
                            </div>
                        </div>


                    <?php endforeach ?>
                </div>
            </div>

            <!-- デキゴト入力ブロック -->
            <form action="./action.php" method="post">
                <!-- <div class="row mt-4 justify-content-end">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <label class="form-label" for="thing">デキゴトの登録
                            <textarea class="form-control" name="thing" id="thing" cols="80" rows="5" maxlength="200" placeholder="デキゴトを入力してください"></textarea>
                            <div class="form-text"></?= Config::TIPS_LL_THING ?></div>
                        </label>
                    </div>
                    <div class="col-sm"></div>
                </div> -->

                <!-- 属性付与ブロック -->
                <div class="row mt-4 justify-content-start">
                    <div class="col-sm-2"></div>
                    <!-- イイコトブロック -->
                    <div class="col-sm-auto align-self-center">
                        <input class="form-check-input" type="checkbox" name="good_thing_flag" id="good_thing_flag" onclick="goodThingLevelDisabled('good_thing_rank',this.checked)" value="1">
                        <label class="form-check-label" for="good_thing_flag">イイコト</label>
                    </div>
                    <div class="col-sm-auto align-self-center">
                        <div class="input-group">
                            <label class="input-group-text" for="good_thing_rank">イイコトランク</label>
                            <select disabled class="level form-select" name="good_thing_rank" id="good_thing_rank">
                                <?php foreach (Config::GOOD_THING_RANK as $i) : ?>
                                    <option value=<?= $i ?>><?= $i ?>位</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- ヤナコトブロック -->
                    <div class="col-sm-auto align-self-center">
                        <input class="form-check-input" type="checkbox" name="bad_thing_flag" id="bad_thing_flag" onclick="badThingLevelDisabled('bad_thing_level',this.checked)" value="1">
                        <label class="form-check-label" for="bad_thing_flag">ヤナコト</label>
                    </div>
                    <div class="col-sm-auto align-self-center">
                        <div class="input-group">
                            <label class="input-group-text" for="bad_thing_level">ヤナコトレベル</label>
                            <select disabled class="level form-select" name="bad_thing_level" id="bad_thing_level">
                                <?php foreach (Config::BAD_THING_LEVEL as $i => $v) : ?>
                                    <option value=<?= $v ?>><?= $i ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mt-4 justify-content-start">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-auto">
                        <div class="form-text text-danger">
                            <?= isset($_SESSION['err']['err_llCheck']) ? $_SESSION['err']['err_llCheck'] : '' ?>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>
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
    </footer>

    <!-- bootstrap JavaScript Bundle with Popper -->
    <script src="../../../css/bootstrap5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>