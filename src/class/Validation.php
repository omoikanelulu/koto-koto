<?php
require_once 'Config.php';

class Validation
{
    /**
     * 文字数チェック完全版
     * @param int $length 最大文字数
     */
    public static function llCheck($str, $length)
    {
        if (mb_strlen($str) <= $length && !empty($str)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * user_name文字数チェック
     */
    public static function llUserName($var)
    {
        if (mb_strlen($var) <= Config::LL_USER_NAME && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * family_name文字数チェック
     */
    public static function llFamilyName($var)
    {
        if (mb_strlen($var) <= Config::LL_FAMILY_NAME && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * first_name文字数チェック
     */
    public static function llFirstName($var)
    {
        if (mb_strlen($var) <= Config::LL_FIRST_NAME && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * メールアドレス文字数チェック
     */
    public static function llUserMailAddress($var)
    {
        if (mb_strlen($var) <= Config::LL_USER_MAIL_ADDRESS && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * パスワード文字数チェック
     */
    public static function llPass($var)
    {
        if (mb_strlen($var) <= Config::LL_PASS && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 正しい年月日かチェック
     * checkdate(int $month, int $day, int $year): bool
     */
    public static function isCorrectDate($year, $month, $day)
    {
        if (!empty($year) && !empty($month) && !empty($day) && checkdate($month, $day, $year)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param var 比較する値が代入された変数
     * :true 一致した
     * :false 一致しない
     */
    public static function isMatched($var1, $var2)
    {
        if ($var1 == $var2) {
            return true;
        } else {
            return false;
        }
    }
}
