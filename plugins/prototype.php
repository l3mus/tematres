<?php
session_start();
require_once 'core/init.php';
use \Plugin_classes\Config;
use \Plugin_classes\DB;
use \Plugin_classes\User;

////echo Config::get('mysql/host');
//
//$user = DB::getInstance()->query("select nombres, apellido from pr_usuario where id = 7");
//if(!$user->error()){
//    if($user->rowsCount()){
//        echo 'User exists<br>';
//    }else{
//        echo 'No such user<br>';
//    }
//}else{
//    echo 'Wrong query<br>';
//}
//foreach($user->results() as $row){
//    foreach($row as $item=>$value){
//        echo $value . ' ';
//    }
//}
////$user->error();

foreach($_SESSION as $row){
    foreach($row as $item=>$value){
        echo $value.'<br>';
    }
}

