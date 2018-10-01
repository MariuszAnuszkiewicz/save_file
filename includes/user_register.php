<?php

use MariuszAnuszkiewicz\classes\Run\Run;

    if (!defined('AUTOLOAD')) {
        define('AUTOLOAD', '../autoload/');
    }
    require_once(AUTOLOAD . "autoloading.php");
    require_once(FORMS . "register_user.html");

Run::initRegisterUser();

if (preg_match('/includes/', $_SERVER['REQUEST_URI'])) {
    ?>
    <div class="redirect_to_login">
        <a style="display: block; position: absolute; top: 330px;" class="home-btn" href="../includes/user_login.php">Zaloguj się</a>
    </div>
    <?php
} else {
    ?>
    <div class="redirect_to_login">
        <a style="display: block; position: absolute; top: 330px;" class="home-btn" href="./includes/user_login.php">Zaloguj się</a>
    </div>
    <?php
}