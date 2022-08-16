<?php
require_once 'Config.php';

class Validation
{
    /**
     * user_name文字数チェック
     */
    public static function llUserName($var)
    {
        if (mb_strlen($var) <= Config::$ll_user_name || $var == '') {
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
        if (mb_strlen($var) <= Config::$ll_family_name || $var == '') {
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
        if (mb_strlen($var) <= Config::$ll_first_name || $var == '') {
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
        if (mb_strlen($var) <= Config::$ll_user_mail_address || $var == '') {
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
        if (mb_strlen($var) <= Config::$ll_pass || $var == '') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 正しい年月日かチェック
     * @param date 年,月,日
     * :true 正しい
     * :false 正しくない
     * checkdate(int $month, int $day, int $year): bool
     */
    public static function isCorrectDate($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) {
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

    /**
     * 担当者を選択しているか
     */
    public static function is_selected_rep($rep)
    {
        if (empty($rep)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 登録済みの担当者かチェックする
     */
    public static function registered_check($infos, $post)
    {
        $has_err = false;
        foreach ($infos as $info => $v) {
            if ($post != ($v['id'])) {
                $_SESSION['err']['unRegRep'] = '登録されていない担当者です';
                $has_err = true;
            } else {
                unset($_SESSION['err']['unRegRep']);
                $has_err = false;
                break;
            }
        }
        return $has_err;
    }
}
