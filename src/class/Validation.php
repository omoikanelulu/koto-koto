<?php
class Validation
{
    /**
     * 文字数チェック
     */
    public static function length_limit($str)
    {
        if (mb_strlen($str) >= 100 || $str == '') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 正しい年月日かチェック
     * @param date 年月日
     * :true 正しい
     * :false 正しくない
     * checkdate(int $month, int $day, int $year): bool
     */
    public static function is_correct_date($date)
    {
        list($year, $month, $day) = explode('-', $date);
        if (checkdate($month, $day, $year)) {
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
