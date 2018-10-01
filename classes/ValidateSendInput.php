<?php namespace MariuszAnuszkiewicz\classes\ValidateSendInput;


class ValidateSendInput
{
    const EMPTY_INPUT = "Pole jest puste, proszę uzupełnić to pole";
    const INVALID_EXTENTION = "Dane wprowadzone do pola mają nieprawidłowe rozszerzenie";

    public function validateEmpty($input, $send)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($send) || $isSet) {
            if (strlen($input) < 1) {
                echo self::EMPTY_INPUT;
                exit;
            }
        }
        return $input;
    }

    public function validateInvalidExtentions($input, $send)
    {
        $isSet = isset($input) ? $input : null;
        if (isset($send) && $isSet) {
            if (!preg_match("/\.(jpg|jpeg|png)(?:[\?\#].*)?$/i", $input)) {
                echo self::INVALID_EXTENTION;
                exit;
            }
        }
        return $input;
    }
}