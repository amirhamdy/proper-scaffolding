<?php

class Session {

    private $logged_in = false;
    public $user;

    function __construct() {
        session_start();
        $this->check_login();
        if ($this->logged_in) {
            //header("Location: index.php");
        } else {
            //header("Location: login.php");
        }
    }

    public function is_logged_in() {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
            session_unset();
            session_destroy();
            $_SESSION['URL'] = $_SERVER['REQUEST_URI'];
            $this->logout();
        } else {
            $_SESSION['LAST_ACTIVITY'] = time();
        }
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } else if (time() - $_SESSION['CREATED'] > 300) {
            session_regenerate_id(true);
            $_SESSION['CREATED'] = time();
        }
        return $this->logged_in;
    }

    public function login($user) {
        if ($user) {
            $this->user       = $_SESSION['user'] = $user;
            $this->logged_in  = true;

            $_SESSION['LAST_ACTIVITY'] = time();
            $_SESSION['CREATED']       = time();
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['LAST_ACTIVITY']);
        unset($_SESSION['CREATED']);
        unset($this->user);
        $this->logged_in = false;
    }

    private function check_login() {
        if (isset($_SESSION['user'])) {
            $this->user      = $_SESSION['user'];
            $this->logged_in = true;
        } else {
            unset($this->user);
            $this->logged_in = false;
        }
    }

}

$session = new Session();
/*
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    session_unset();
    session_destroy();
    $_SESSION['alert'] = "Please login again";
    redirect_to("logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 300) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

 */
