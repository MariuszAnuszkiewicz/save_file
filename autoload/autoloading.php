<?php
session_start();

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(dirname(__FILE__)));
}
if (!defined('WEB')) {
    define('WEB', ROOT.DS."web");
}
if (!defined('FORMS')) {
    define('FORMS', ROOT.DS."web/forms/");
}
if (!defined('INCLUDES')) {
    define('INCLUDES', ROOT.DS."includes/");
}

function autoloadClasses($class) {

    $posStart = strripos($class, '\\');
    $posEnd = strlen($class);
    $className = substr(ltrim($class), $posStart + 1, $posEnd);
    $fileClass = ROOT.DS . 'classes' . DS . str_replace('\\', DS, ucfirst($className)) . '.php';
    $fileConfig = ROOT.DS . 'config'. DS . str_replace('\\', DS, $className) . '.php';

    if($posStart) {
        if (is_readable($fileClass)) {
            require_once "$fileClass";
        }
        if (is_readable($fileConfig)) {
            require_once "$fileConfig";
        }
    }
    else {
        throw new Exception('Failed to include class '. $className);
    }
}

spl_autoload_register('autoloadClasses');


