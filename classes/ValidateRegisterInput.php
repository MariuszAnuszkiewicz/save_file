<?php namespace MariuszAnuszkiewicz\classes\ValidateRegisterInput;

use MariuszAnuszkiewicz\classes\Database\DB;

class ValidateRegisterInput
{
    const INVALID_PATTERN = "Pole tekstowe powinno zawierać znaki literowe";
    const EMPTY_INPUT = "Wartość pola jest pusta";
    const TOO_LONG = "Wartość wprowadzona w pole jest za długa";
    const INVALID_EMAIL = "Pole email ma nieprawidłowy format";
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function checkUserExists($input)
    {
        $sql = "SELECT email FROM users WHERE email = ?";
        $this->db->query($sql, array($input));
        $result = $this->db->results();
        $status = null;
        foreach($result as $row) {
            if ($row['email'] === $input) {
                $status = true;
            }
        }
        return $status;
    }

    public function validateLength($input, $submit)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($submit) || $isSet) {
            if (!preg_match('/^[a-zA-Z]*$/', $input)) {
                    echo self::INVALID_PATTERN;
                if (strlen($input) < 1) {
                    echo self::EMPTY_INPUT;
                    exit;
                } elseif (strlen($input) > 99) {
                    echo self::TOO_LONG;
                    exit;
                }
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