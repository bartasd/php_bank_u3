<?php
namespace Bank\App\Services;

class Message {

    public static function set($message, $type){
        $_SESSION['data'] = [$message, $type];
    }
    public static function get(){
        return $_SESSION['data'] ?? null;
    }
    public static function reset(){
        $_SESSION['data'] = null;
    }

    private function __construct(){
        
    }
}