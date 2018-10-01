<?php namespace MariuszAnuszkiewicz\classes\HashPassword;


class HashPassword
{
    private $hashInput;

    public function encrypt($input)
    {
       $options = [
         'salt' => 'FG%7h62CXhi9@zqIdea12345',
         'cost' => 11
       ];

       return $this->hashInput = password_hash($input,  PASSWORD_BCRYPT, $options);
    }
}