<?php

/**
 * @param int $start 最小日
 * @param int $end 最大日
 */
function days_select($start, $end)
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
function months_select($start, $end)
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
function years_select($start, $end)
{
    $years = array();
    for ($i = $start; $i <= $end; $i++) {
        $years[] = $i;
    }
    return $years;
}
