<?php namespace MariuszAnuszkiewicz\classes\ValidateSendInput;

class ValidateSendInput
{
    const EMPTY_INPUT = "Pole jest puste, proszę uzupełnić to pole";
    const INVALID_EXTENTION = "Dane wprowadzone do pola mają nieprawidłowe rozszerzenie";

    public function validateEmpty($input, $send)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($send) || $isSet) {
            if (strlen($this->escape($input)) < 1) {
                echo self::EMPTY_INPUT;
                exit;
            }
        }
        return $this->escape($input);
    }

    public function validateInvalidExtentions($input, $send)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($send) && $isSet) {
            if (!preg_match("/\.(jpg|jpeg|png)(?:[\?\#].*)?$/i", $this->escape($input))) {
                echo self::INVALID_EXTENTION;
                exit;
            }
        }
        return $this->escape($input);
    }

    public function escape($input) {
        return htmlentities(trim($input), ENT_QUOTES);
    }
}