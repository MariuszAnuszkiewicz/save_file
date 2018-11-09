<?php

use MariuszAnuszkiewicz\classes\Run;
use MariuszAnuszkiewicz\classes\ValidateSendInput\ValidateSendInput;
use MariuszAnuszkiewicz\classes\Session;

    if (!defined('AUTOLOAD')) {
        define('AUTOLOAD', '../autoload/');
    }
    require_once(AUTOLOAD . "autoloading.php");
    require_once(FORMS . "send_data.html");

    if (Session::exists('user') && Session::get('user')) {
        echo Session::flash('login');
    }
    $validateObj = new ValidateSendInput();

    $inputs = [
       'name' => isset($_POST['name']) ? $_POST['name'] : null,
       'surname' => isset($_POST['surname']) ? $_POST['surname'] : null,
       'file' => isset($_POST['file']) ? $_POST['file'] : null,
       'submit' => isset($_POST['submit']) ? $_POST['submit'] : null
    ];

    $submit = $inputs['submit'];
    $name = $validateObj->validateEmpty($inputs['name'], $inputs['submit']);
    $surname = $validateObj->validateEmpty($inputs['surname'], $inputs['submit']);
    $file = $validateObj->validateInvalidExtentions($inputs['file'], $inputs['submit']);

    $filePath = __DIR__ . "/../web/uploads/data.json";

    if (Run::initGetSaveFile($submit, $name, $surname, $file, $filePath) == true) {
        header("Location: ../views/list_data.php");
    } else {
        exit;
    }

