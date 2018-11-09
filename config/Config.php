<?php namespace MariuszAnuszkiewicz\Config;

class Config {

    protected static $settings = [];

    public static function get($key) {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function set($key, $value) {
        self::$settings[$key] = $value;
    }
}

// database

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'user');

// sessions

Config::set('session_name', 'user');

// save file

Config::set('link_save_file', $_SERVER['REQUEST_URI'] . "/../../web/uploads/data.json");
Config::set('save_file',  __DIR__ . "/../web/uploads/data.json");
