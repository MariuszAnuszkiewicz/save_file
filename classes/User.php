<?php namespace MariuszAnuszkiewicz\classes;

use MariuszAnuszkiewicz\Config\Config;

class User
{
    public $loggedIn;
    private $db;
    private $userId;
    private $userEmail;
    private $userName;
    private $sessionName;

    public function __construct($email = null)
    {
        $this->db = DB::getInstance();
        $this->sessionName = Config::get('session.session_name');
        if (!$email) {
            $this->loggedIn = false;
        } else {
            $this->userId = $this->getIdByEmail($email);
            $this->userName = $this->getUsernameByEmail($email);
            $this->userEmail = $email;
            $this->loggedIn = true;
        }
    }

    public function getIdByEmail($email)
    {
        $sql = "SELECT id FROM users WHERE email = ?";
        $this->db->query($sql, array($email));
        $row = $this->db->results();
        $output = null;
        for ($i = 0; $i < $this->db->countRow(); $i++) {
            $output[] = $row[$i]['id'];
        }
        return $output;
    }

    public function getUsernameByEmail($email)
    {
        $sql = "SELECT username FROM users WHERE email = ?";
        $this->db->query($sql, array($email));
        $row = $this->db->results();
        $output = null;
        for ($i = 0; $i < $this->db->countRow(); $i++) {
            $output[] = $row[$i]['username'];
        }
        return $output;
    }

    public function getPasswordByEmail($email)
    {
        $sql = "SELECT password FROM users WHERE email = ?";
        $this->db->query($sql, array($email));
        $row = $this->db->results();
        $output = null;
        for ($i = 0; $i < $this->db->countRow(); $i++) {
            $output[] = $row[$i]['password'];
        }
        return $output;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getSessionName()
    {
        return $this->sessionName;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }
}
