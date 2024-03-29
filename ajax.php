<?php

include 'src/Models/Auth.php';
include 'src/Models/AjaxRequest.php';
include 'src/Models/Jsondb.php';

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();

class AuthorizationAjaxRequest extends AjaxRequest
{
    
    public $actions = array(
        "login" => "login",
        "logout" => "logout",
        "register" => "register",
    );

    public function login()
    {
        
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }
        
        setcookie("sid", "");
        
        $username = $this->getRequestParam("username");
        $password = $this->getRequestParam("password");
        $remember = !!$this->getRequestParam("remember-me");
        
        if (empty($username)) {
            $this->setFieldError("username", "Enter the username");
            return;
        }

        

        if (empty($password)) {
            $this->setFieldError("password", "Enter the password");
            return;
        }
        
        $user = new Auth\User();
        $auth_result = $user->authorize($username, $password, $remember);
        
        if (!$auth_result) {
            
            $this->setFieldError("password", "Invalid username or password");
            return;
        }

        $this->status = "ok";
        $this->setResponse("redirect", "/");
        $this->message = sprintf("Hello, %s! Access granted.", $username);
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }

        setcookie("sid", "");

        $user = new Auth\User();
        $user->logout();

        $this->setResponse("redirect", "/");
        $this->status = "ok";
    }

    public function register()
    {
        
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }

        setcookie("sid", "");

        $username = $this->getRequestParam("username");
        $password1 = $this->getRequestParam("password1");
        $password2 = $this->getRequestParam("password2");
        $email = $this->getRequestParam("email");
        $name = $this->getRequestParam("name");

        if (empty($username)) {
            $this->setFieldError("username", "Enter the username");
            return;
        }

        if ((preg_match("/[\s]{1}/i",$username))) {
                $this->setFieldError("username", "Username only numbers and letters");
                return;
            }

            if ((preg_match("/^\s{1}/",$username))) {
                $this->setFieldError("username", "Username only numbers and letters");
                return;
            }

            if ((preg_match("/[\s]{1}/i",$password1))) {
                $this->setFieldError("password", "Password only numbers and letters");
                return;
            }

            if ((preg_match("/^\s{1}/",$password1))) {
                $this->setFieldError("password", "Password only numbers and letters");
                return;
            }

        if ((preg_match("/[a-zа-яё]{1}/i",$password1))) {
            if (!(preg_match("/[\d]{1}/i",$password1))) {
                $this->setFieldError("password", "Password only numbers and letters");
                return;
            }
        }else{
            $this->setFieldError("password", "Password only - numbers and letters");
            return;
        }

        if (empty($password1)) {
            $this->setFieldError("password1", "Enter the password");
            return;
        }

        if (empty($password2)) {
            $this->setFieldError("password2", "Confirm the password");
            return;
        }

        if ($password1 !== $password2) {
            $this->setFieldError("password2", "Confirm password is not match");
            return;
        }

        $user = new Auth\User();
        if($user->getUser($username))
        {
            $this->setFieldError("username", "Username exist");
            return;
        }

        if (!(preg_match("/@{1}[a-zа-яё]+[.]{1}/",$email))) {
            $this->setFieldError("email", "Email type error");
            return;
        }

        if($user->getEmail($email))
        {
            $this->setFieldError("email", "Email exist");
            return;
        }
        $user->create($username, $password1, $email, $name);
        $user->authorize($username, $password1, $remember);

        $this->message = sprintf("Hello, %s! Thank you for registration.", $username);
        $this->setResponse("redirect", "/");
        $this->status = "ok";
    }
}

$ajaxRequest = new AuthorizationAjaxRequest($_REQUEST);
$ajaxRequest->showResponse();
