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