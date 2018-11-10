<?php namespace MariuszAnuszkiewicz\Config;

abstract class Setting {

    protected static $settings = [];

    abstract public static function get($key);
    abstract public static function set($key, $value);
}

