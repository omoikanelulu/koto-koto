<?php
require_once 'Security.php';

Security::session();

class Util
{
    // デキゴトの処理で使用するキャンセル処理
    public static function thingsCancel()
    {
        // $_SESSIONに編集前のデキゴトがあればunsetする
        if (isset($_SESSION['thing']) == true) {
            unset($_SESSION['thing']);
        }
        // $_SESSIONにユーザが入力したデータがあればunsetする
        if (isset($_SESSION['edit_thing']) == true) {
            unset($_SESSION['edit_thing']);
        }
        // $_SESSIONにエラーメッセージがあればunsetする
        if (isset($_SESSION['err']) == true) {
            unset($_SESSION['err']);
        }
        // $_SESSIONにverifiedがあればunsetする
        if (isset($_SESSION['verified']['confirm']) == true) {
            unset($_SESSION['verified']['confirm']);
        }
        if (isset($_SESSION['verified']['checkId']) == true) {
            unset($_SESSION['verified']['checkId']);
        }
        if (isset($_SESSION['verified']['action']) == true) {
            unset($_SESSION['verified']['action']);
        }
    }

    // ユーザの処理で使用するキャンセル処理
    public static function usersCancel()
    {
        // $_SESSIONにユーザが入力したデータがあればunsetする
        if (isset($_SESSION['input_user_data']) == true) {
            unset($_SESSION['input_user_data']);
        }
        // $_SESSIONに編集用の新規データがあればunsetする
        if (isset($_SESSION['edit_user_data']) == true) {
            unset($_SESSION['edit_user_data']);
        }
        // $_SESSIONにエラーメッセージがあればunsetする
        if (isset($_SESSION['err']) == true) {
            unset($_SESSION['err']);
        }
        // $_SESSIONにverifiedがあればunsetする
        if (isset($_SESSION['verified']['confirm']) == true) {
            unset($_SESSION['verified']['confirm']);
        }
        if (isset($_SESSION['verified']['checkId']) == true) {
            unset($_SESSION['verified']['checkId']);
        }
    }
}
