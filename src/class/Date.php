<?php

/**
 * @param int $start 最小日
 * @param int $end 最大日
 */
function days_select($start, $end)
{
    for ($i = $start; $i <= $end; $i++) {
        $days = '<option value="' . $i . '">' . $i . '</option>';
        return $days;
    }
}

/**
 * @param int $start 最小月
 * @param int $end 最大月
 */
function months_select($start, $end)
{
    for ($i = $start; $i <= $end; $i++) {
        $months = '<option value="' . $i . '">' . $i . '</option>';
        return $months;
    }
}

/**
 * @param int $start 最小年
 * @param int $end 最大年
 */
function years_select($start, $end)
{
    for ($i = $start; $i <= $end; $i++) {
        $years = '<option value="' . $i . '">' . $i . '</option>';
        return $years;
    }
}
