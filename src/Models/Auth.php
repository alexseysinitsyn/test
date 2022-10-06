<?php

namespace Auth;
use Models\Jsondb;

class User
{
    private $username;
    private $is_authorized = false;

    public static function isAuthorized()
    {
        if (!empty($_SESSION["username"])) {
            return (bool) $_SESSION["username"];
        }
        return false;
    }

    public function passwordHash($password)
    {
       return $hash = sha1($password);
    }

    public function getUser($username)
    {
        $db  = new Jsondb();
        $arr =  $db->rDataBase('users.json');
        foreach($arr as $index) {
        $key = strrpos($index,$username);
            if ($key) {
            return true;
            }
        }
            return false;
    }

    public function getPass($username, $password)
    {
        $db  = new Jsondb();
        $arr =  $db->rDataBase('users.json');
       foreach($arr as $index) 
       {
            if(strrpos($index,$username) && strrpos($index,sha1($password)))
            {
            return true;
            }
        }
        return false;
    }

    public function getEmail($email)
    {
        $db  = new Jsondb();
        $arr =  $db->rDataBase('users.json');
        foreach($arr as $index) {
        $key = strrpos($index,$email);
            if ($key) {
            return true;
            }
        }
    return false;
    }

    public function authorize($username, $password, $remember=false)
    {  
        if($this->getUser($username)){
        if ($this->getPass($username, $password)) {
            
            $this->is_authorized = true;
            $this->username = $username;
            $this->saveSession($remember);
        }else {
            $this->is_authorized = false;
        }
        }else{
            $this->is_authorized = false;
        }
        return $this->is_authorized;
    }

    public function logout()
    {
        
        if (!empty($_SESSION["username"])) {
            unset($_SESSION["username"]);
        }
    }

    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["username"] = $this->username;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function create($username, $password, $email, $name) {
        $hashes = $this->passwordHash($password);
        $jdb  = new Jsondb();
        $result = $jdb->uDataBase('users.json',[$username, $hashes, $email, $name]);
    }
}