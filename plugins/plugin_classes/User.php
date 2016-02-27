<?php
session_start(); //This statement should be used only with Ajax
use \Plugin_classes\DB as DBase;
use \Plugin_classes\Config;
class User{
    private $_result;

    public static function exists(){
        if((isset($_POST['username']) && isset($_POST['password'])) && (!empty($_POST['username'])) && !empty($_POST['password'])) {
            if (DBase::getInstance()->query("select mail, pass form pr_usuario where mail = '{$_POST['username']}' and pass = '{$_POST['password']}'")) {
                return true;
            }
        }
        return false;
    }
}