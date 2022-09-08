/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * デキゴト記録画面用
 */
function goodThingRankDisabled(good_thing_rank, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたらdisabledしない
        document.getElementById(good_thing_rank).disabled = false;
    }
    else {
        // チェックが入っていなかったらdisabledする
        document.getElementById(good_thing_rank).disabled = true;
        document.getElementById(good_thing_rank).value = '';
    }
}

/**
 * チェックボックスにチェックが入っている時だけ、入力出来るようになる
 * デキゴト記録画面用
 */
function badFactorDisabled(is_checked) {
    var list = document.querySelectorAll('.bad_factor')
    if (is_checked == true) {
        for (let i = 0; i < list.length; i++) {
            list[i].disabled = false;
        }
    } else {
        for (let i = 0; i < list.length; i++) {
            list[i].disabled = true;
            list[i].value = '';
        }
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