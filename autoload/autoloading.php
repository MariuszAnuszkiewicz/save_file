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
    $pos_start = strripos($class, '\\');
    $pos_end = strlen($class);
    $class_name = substr(ltrim($class), $pos_start+1, $pos_end);
    $file_class = ROOT . DS . 'classes' . DS . str_replace('\\', DS, ucfirst($class_name)) . '.php';
    $file_config = ROOT . DS . 'config'. DS . str_replace('\\', DS, $class_name) . '.php';
    $file_view = ROOT . DS . 'views'. DS . str_replace('\\', DS, $class_name) . '.php';
    $hepler_files = ROOT . DS . 'helper'. DS . str_replace('\\', DS, $class_name) . '.php';

    if($pos_start) {
        if (is_readable($file_class)) {
            require_once "$file_class";
        }
        if (is_readable($file_config)) {
            require_once "$file_config";
        }
        if (is_readable($file_view)) {
            require_once "$file_view";
        }
        if (is_readable($hepler_files)) {
            require_once "$hepler_files";
        }
    }
    else {
        throw new Exception('Failed to include class '. $class_name);
    }
}

spl_autoload_register('autoloadClasses');


