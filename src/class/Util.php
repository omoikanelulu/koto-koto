<?php

/**
 * 現在のURLを取得する
 */
function get_uri()
{
    $current_page = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $current_page;
}

/**
 * 現在のファイル名を取得する
 */
function get_file_name()
{
    echo $_SERVER['REQUEST_URI'];
    return;
}
