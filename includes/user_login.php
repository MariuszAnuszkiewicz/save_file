<?php

use MariuszAnuszkiewicz\classes\Run\Run;
use MariuszAnuszkiewicz\classes\Session\Session;

    if (!defined('AUTOLOAD')) {
        define('AUTOLOAD', '../autoload/');
    }
    require_once(AUTOLOAD . "autoloading.php");
    require_once(FORMS . "login_user.html");

Run::initLoginUser();

if (isset($_SERVER['HTTP_REFERER']) && !Session::exists('user')) {
    if ($_SERVER['HTTP_REFERER']) {
        echo 'Wylogowałeś się pomyślnie';
   }
}
