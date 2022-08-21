<?php
require_once '../../../class/Config.php';
require_once '../../../class/Base.php';
require_once '../../../class/Security.php';
require_once '../../../class/Validation.php';

// セッションスタート
Security::session();

$ins = new Base();

Security::logout();

header('Location:' . $ins->top_page_url);
