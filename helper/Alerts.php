<?php namespace MariuszAnuszkiewicz\helper;


class Alerts
{
   public static $alert = [
       "save_success" => "<p>Dane zostały zapisane prawidłowo.</p>",
       "register_success" => "<p>Rejestracja użytkownika przebiegła prawidłowo.</p>",
       "register_failed" => "<p>Taki użytkownik już istnieje. Proszę wpisać nazwę nowego Użytkownika.</p>",
       "login_failed" => "<p>Nieprawidłowy login, proszę poprawić pola logowania.</p>",
       "empty_database" => "<p>Brak użytkowników w bazie danych.</p>"
   ];

   public static function getAlert($key)
   {
       return self::$alert[$key];
   }
}