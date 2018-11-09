<?php namespace MariuszAnuszkiewicz\classes;

use MariuszAnuszkiewicz\helper\Alerts;

class UserRegister
{
   private $db;
   private $hash;
   private $validate;

   public function __construct()
   {
       $this->db = DB::getInstance();
       $this->hash = new HashPassword();
       $this->validate = new ValidateRegisterInput();
   }

   public function register($username, $email, $password)
   {
      if ($this->validate->checkUserExists($email) == true){
         echo Alerts::$alert['register_failed'];
      } else {
         $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
         $this->db->query($sql, array($this->validate->escape($username), $this->validate->escape($email), $this->validate->escape($this->hash->encrypt($password))));
      }
	  header("Location: ../includes/user_login.php");
   }
}