<?php
namespace Bank\App\Services;
use Bank\App\DB\FileBase;

class Auth{

    private static $auth;
    private $login = false;
    private $user;

    public static function get(){
        return self::$auth ?? self::$auth = new self;
    }

    private function __construct(){
        if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
            $this->login = true;
            $this->user = $_SESSION['user'];
        }
    }

    public function getStatus(){
        if($this->login){
            return $this->user;
        }
        return false;
    }

    public function tryLogin($u, $p){
        $writer = new FileBase('admins');
        $admins = $writer->showAll();
        foreach($admins as $admin){
            if($admin->user == $u && $admin->pass == md5($p)){
                $_SESSION['login'] = 1;
                $_SESSION['user'] = $u;
                return true;
            }
        }
        return false;
    }

    public function logout() : void {
        unset($_SESSION['login']);
        unset($_SESSION['user']);
    }
}