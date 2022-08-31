/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * デキゴト記録画面用
 */
function goodThingLevelDisabled(good_thing_level, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(good_thing_level).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(good_thing_level).disabled = true;
    }
}

/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * デキゴト記録画面用
 */
function badThingLevelDisabled(bat_thing_level, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(bat_thing_level).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(bat_thing_level).disabled = true;
    }
}

/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * ユーザ情報編集画面用
 */
function userNameDisabled(user_name, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(user_name).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(user_name).disabled = true;
        document.getElementById(user_name).value = '';
    }
}

/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * ユーザ情報編集画面用
 */
function userMailAddressDisabled(user_mail_address, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(user_mail_address).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(user_mail_address).disabled = true;
        document.getElementById(user_mail_address).value = '';
    }
}

/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * ユーザ情報編集画面用
 */
function passDisabled(pass, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(pass).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(pass).disabled = true;
    }
}
// ここを作るマウスを乗せたらアイコンが出てくるように
function editButtonEnabled(){
    document.getElementById(pass).disabled = true;

}