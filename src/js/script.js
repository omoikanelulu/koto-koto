function userNameDisabled(user_name, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたら有効化
        document.getElementById(user_name).disabled = false;
    }
    else {
        // チェックが入っていなかったら無効化
        document.getElementById(user_name).disabled = true;
    }
}

function userMailAddressDisabled(user_mail_address, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたら有効化
        document.getElementById(user_mail_address).disabled = false;
    }
    else {
        // チェックが入っていなかったら無効化
        document.getElementById(user_mail_address).disabled = true;
    }
}

function passDisabled(pass, is_checked) {
    if (is_checked == true) {
        // チェックが入っていたら有効化
        document.getElementById(pass).disabled = false;
    }
    else {
        // チェックが入っていなかったら無効化
        document.getElementById(pass).disabled = true;
    }
}