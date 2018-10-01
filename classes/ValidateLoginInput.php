<?php namespace MariuszAnuszkiewicz\classes\ValidateLoginInput;

use MariuszAnuszkiewicz\classes\Database\DB;

class ValidateLoginInput
{
    const EMPTY_INPUT = "Wartość pola jest pusta";
    const TOO_LONG = "Wartość wprowadzona w pole jest za długa";
    const MIN_VALUE = "Wartość pola musi wynosić przynajmniej 4 znaki";
    const INVALID_EMAIL = "Pole email ma nieprawidłowy format";

    public function validateLength($input, $submit)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($submit) || $isSet) {
            if (strlen($input) < 1) {
                echo self::EMPTY_INPUT;
                exit;
            }
            elseif (strlen($input) > 99) {
                echo self::TOO_LONG;
                exit;
            }
        }
        return $input;
    }

    public function validateEmail($input, $submit)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($submit) || $isSet) {

            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                echo self::INVALID_EMAIL;
                exit;
            }
            elseif (strlen($input) < 1) {
                echo self::EMPTY_INPUT;
                exit;
            }
            elseif (strlen($input) > 99) {
                echo self::TOO_LONG;
                exit;
            }
        }
        return $input;
    }

    public function escape($input) {
        return htmlentities(trim($input), ENT_QUOTES);
    }
}