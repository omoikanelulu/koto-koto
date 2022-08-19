<?php

class Config //staticプロパティは内容が変化しないのものを設定しておくと良さげ
{
    // 日付関係
    public static $first_year = '2020';
    public static $months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    public static $days = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

    // 文字数制限
    public static $ll_user_name = '50';
    public static $ll_family_name = '20';
    public static $ll_first_name = '20';
    public static $ll_user_mail_address = '50';
    public static $ll_pass = '50';

    // サイトタイトル
    public static $site_title = 'koto-koto';

    // エラーメッセージ
    public static $err_msg = '申し訳ございません<br>予期せぬエラーが発生いたしました<br>時間を置いてから再度お試しください';
    public static $err_is_correct_date = '正しい日付ではありません';
    public static $err_is_matched = '一致しません';

    // エラーメッセージ（文字数制限）
    public static $err_ll_user_name = '文字数は50文字以内にしてください';
    public static $err_ll_family_name = '文字数は20文字以内にしてください';
    public static $err_ll_first_name = '文字数は20文字以内にしてください';
    public static $err_ll_user_mail_address = '文字数は50文字以内にしてください';
    public static $err_ll_pass = '文字数は50文字以内にしてください';

    // エラーメッセージ（メソッド）
    public static $err_userLogin = 'ご登録されていないか、入力に誤りがあります';
}
