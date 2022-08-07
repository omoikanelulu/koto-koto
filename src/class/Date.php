<?php

class Date
{
    /**
     * 今年の年を代入する
     */
    public function __constract()
    {
        $this_year = date('Y');
        return $this_year;
    }

    // 下記は年、月、日をfor文で作成して、変数に代入する為に使っていた
    // 今はConfig.phpにまとめたのでもう使用されないと思われる
    /**
     * @param int $start 最小日
     * @param int $end 最大日
     */
    // public function days_select($start, $end)
    // {
    //     $days = array();
    //     for ($i = $start; $i <= $end; $i++) {
    //         $days[] = $i;
    //     }
    //     return $days;
    // }

    /**
     * @param int $start 最小月
     * @param int $end 最大月
     */
    // public function months_select($start, $end)
    // {
    //     $months = array();
    //     for ($i = $start; $i <= $end; $i++) {
    //         $months[] = $i;
    //     }
    //     return $months;
    // }

    /**
     * @param int $start 最小年
     * @param int $end 最大年
     */
    // public function years_select($start, $end)
    // {
    //     $years = array();
    //     for ($i = $start; $i <= $end; $i++) {
    //         $years[] = $i;
    //     }
    //     return $years;
    // }
}
