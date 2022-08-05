<?php
// staticはやめる
class Date
{
/**
 * 今年の年を指定する
 */
public function__constract(){
    $this_year = date('Y');
}


    /**
     * @param int $start 最小日
     * @param int $end 最大日
     */
    public static function days_select($start, $end)
    {
        $days = array();
        for ($i = $start; $i <= $end; $i++) {
            $days[] = $i;
        }
        return $days;
    }

    /**
     * @param int $start 最小月
     * @param int $end 最大月
     */
    public static function months_select($start, $end)
    {
        $months = array();
        for ($i = $start; $i <= $end; $i++) {
            $months[] = $i;
        }
        return $months;
    }

    /**
     * @param int $start 最小年
     * @param int $end 最大年
     */
    public static function years_select($start, $end)
    {
        $years = array();
        for ($i = $start; $i <= $end; $i++) {
            $years[] = $i;
        }
        return $years;
    }
}
