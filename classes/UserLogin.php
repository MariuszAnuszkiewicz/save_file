<?php namespace MariuszAnuszkiewicz\classes\UserLogin;

use MariuszAnuszkiewicz\classes\Database\DB;
use MariuszAnuszkiewicz\classes\HashPassword\HashPassword;
use MariuszAnuszkiewicz\classes\User\User;
use MariuszAnuszkiewicz\classes\ValidateLoginInput\ValidateLoginInput;
use MariuszAnuszkiewicz\classes\Session\Session;
use MariuszAnuszkiewicz\helper\Alerts\Alerts;

class UserLogin
{
    private $db;
    private $hash;
    private $user;
    private $validate;
    private $extractPassword;
    private $extractForSessions;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->user = new User(null);
        $this->hash = new HashPassword();
        $this->validate = new ValidateLoginInput();
    }

    public function login($email, $password)
    {
        $this->user = new User($email);
        if ($this->db->countRow() > 0) {
            foreach ($this->user->getPasswordByEmail($email) as $extractPassword) {
                $this->extractPassword['DB'] = $extractPassword;
            }
        } else {
            echo Alerts::$alert['empty_database'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($email) && !empty($password)) {
                if ($this->hash->encrypt($password) === $this->extractPassword['DB'] && $this->user->isLoggedIn() == true) {
                    $this->extractForSessions = [
                        'id' => $this->user->getUserId(),
                        'email' => $this->user->getUserEmail()
                    ];
                    Session::set($this->user->getSessionName(), $this->extractForSessions);
                    header("Location: ../includes/save_file.php");
                    return Session::flash('login','Zalogowałeś się Pomyślnie');
                } else {
                    return Session::flash('login_failed','Zalogowanie nie powiodło się, popraw pola logowania');
                }
            }
        }
    }

    public function logout()
    {
        $sessionKey = $this->user->getSessionName();
        Session::delete($sessionKey);
        if (session_destroy()) {
            header("Location: ../includes/user_login.php");
        }
    }

    public function getUser()
    {
        return $this->user;
    }
}