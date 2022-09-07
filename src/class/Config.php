<?php

class Config //staticプロパティは内容が変化しないのものを設定しておくと良さげ
{
    // サイトタイトル
    public const SITE_TITLE = 'koto-koto';

    // 日付関係
    public const FIRST_YEAR = '2020';
    // public static $first_year = '2020'; //こう書くと定数じゃない
    public const MONTHS = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    public const DAYS = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

    // things関係
    public const GOOD_THING_RANK = array('--', '1', '2', '3');
    public const BAD_THING_LEVEL = array('--' => '0', '小' => '1', '中' => '2', '大' => '3');

    // 文字数制限（user関係）
    public const LL_USER_NAME = '50';
    public const LL_FAMILY_NAME = '20';
    public const LL_FIRST_NAME = '20';
    public const LL_USER_MAIL_ADDRESS = '50';
    public const LL_PASS = '50';

    // 文字数制限（things関係）
    public const LL_THING = '200';
    public const LL_APPROACH = '1000';

    // Tipsメッセージ
    public const TIPS_LL_THING = '登録文字数は1文字以上' . self::LL_THING . '文字以内です';
    public const TIPS_LL_APPROACH = '登録文字数は1文字以上' . self::LL_APPROACH . '文字以内です';

    // successメッセージ
    public const SUCCESS_THINGS_ADD = 'デキゴト登録が完了しました';
    public const SUCCESS_THINGS_UPDATE = 'デキゴト更新が完了しました';

    // エラーメッセージ
    public const ERR_MSG = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';
    public const ERR_IS_CORRECT_DATE = '正しい日付ではありません';
    public const ERR_IS_MATCHED = '一致しません';
    public const ERR_THING_SHOW = 'ご登録がありません';

    // エラーメッセージ（文字数制限）
    public const ERR_LL_USER_NAME = '文字数は1文字以上' . self::LL_USER_NAME . '文字以内にしてください';
    public const ERR_LL_FAMILY_NAME = '文字数は1文字以上' . self::LL_FAMILY_NAME . '文字以内にしてください';
    public const ERR_LL_FIRST_NAME = '文字数は1文字以上' . self::LL_FIRST_NAME . '文字以内にしてください';
    public const ERR_LL_USER_MAIL_ADDRESS = '文字数は1文字以上' . self::LL_USER_MAIL_ADDRESS . '文字以内にしてください';
    public const ERR_LL_PASS = '文字数は1文字以上' . self::LL_PASS . '文字以内にしてください';
    public const ERR_LL_THING = '文字数は1文字以上' . self::LL_THING . '文字以内にしてください';
    public const ERR_LL_APPROACH = '文字数は1文字以上' . self::LL_APPROACH . '文字以内にしてください';

    // エラーメッセージ（メソッド）
    public const ERR_USER_LOGIN = 'ご登録されていないか、入力に誤りがあります';
    public const ERR_CHECK_ID = 'ご登録された情報を入力してください';
    public const ERR_IS_ARRAY_EMPTY = '入力がされていません';
}
