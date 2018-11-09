<?php namespace MariuszAnuszkiewicz\classes;

class ValidateRegisterInput
{
    const INVALID_USERNAME_PATTERN = "Pole tekstowe powinno zawierać tylko znaki literowe";
	const INVALID_PASSWORD_PATTERN = "Pole password powinno zawierać znaki literowe i lub cyfry";
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
			if (strlen($this->escape($input)) < 1) {
				echo self::EMPTY_INPUT;
				exit;
			} elseif (strlen($this->escape($input)) > 99) {
				echo self::TOO_LONG;
				exit;
			} 
        }
        return $this->escape($input);
    }

    public function validateEmail($input, $submit)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($submit) || $isSet) {
            if (!filter_var($this->escape($input, FILTER_VALIDATE_EMAIL))) {
                echo self::INVALID_EMAIL;
                exit;
            }
            elseif (strlen($this->escape($input)) < 1) {
                echo self::EMPTY_INPUT;
                exit;
            }
            elseif (strlen($this->escape($input)) > 99) {
                echo self::TOO_LONG;
                exit;
            }
        }
        return $this->escape($input);
    }
	
	public function validateUsername($input)
	{
	  if (!preg_match('/^[a-zA-Z]*$/', $this->escape($input))) {
			echo self::INVALID_USERNAME_PATTERN;
			exit;
		}
	}
	
	public function validatePassword($input)
	{
	  if (!preg_match('/^[a-zA-Z0-9]*$/', $this->escape($input))) {
			echo self::INVALID_PASSWORD_PATTERN;
			exit;
		}
	}

    public function escape($input) {
        return htmlentities(trim($input), ENT_QUOTES);
    }
}