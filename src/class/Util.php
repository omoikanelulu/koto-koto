<?php

class Util
{
    /**
     * 現在のURLを取得する
     */
    public static function get_uri()
    {
        $current_page = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $current_page;
    }

    /**
     * 現在のファイル名を取得する
     */
    public static function get_file_name()
    {
        echo $_SERVER['REQUEST_URI'];
        return;
    }
}
