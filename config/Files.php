<?php namespace MariuszAnuszkiewicz\Config;

class Files extends Setting
{
    public static function get($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}

// save file

    Files::set('link_save_file', $_SERVER['REQUEST_URI'] . "/../../web/uploads/data.json");
    Files::set('save_file',  __DIR__ . "/../web/uploads/data.json");
