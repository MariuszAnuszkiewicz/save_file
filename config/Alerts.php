<?php namespace MariuszAnuszkiewicz\Config;

class Alerts extends Setting
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

Alerts::set('save_success', 'Dane zostały zapisane prawidłowo.');
Alerts::set('logout_success', 'Wylogowałeś się pomyślnie.');
Alerts::set('register_success', 'Rejestracja użytkownika przebiegła prawidłowo.');
Alerts::set('register_failed', 'Taki użytkownik już istnieje. Proszę wpisać nazwę nowego Użytkownika.');
Alerts::set('empty_database', 'Brak użytkowników w bazie danych.');