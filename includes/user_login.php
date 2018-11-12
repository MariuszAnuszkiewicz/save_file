<?php

use MariuszAnuszkiewicz\classes\Run;
use MariuszAnuszkiewicz\classes\Session;
use MariuszAnuszkiewicz\Config\Alerts;

    if (!defined('AUTOLOAD')) {
        define('AUTOLOAD', '../autoload/');
    }
    require_once(AUTOLOAD . "autoloading.php");
    require_once(FORMS . "login_user.html");

    Run::initLoginUser();

if (!Session::exists('user')) {
    echo Session::flash('login_failed');
}

if (isset($_SERVER['HTTP_REFERER'])) {
    if (preg_match('/list_data/', $_SERVER['HTTP_REFERER']) && !Session::exists('user')) {
        echo Alerts::get('logout_success');
    }
    if (preg_match('/user_register/', $_SERVER['HTTP_REFERER']) && !Session::exists('user')) {
        echo Alerts::get('register_success');
    }
}