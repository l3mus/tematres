
<?php
session_start();
require_once '..'.DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.'sanitize.php';
require_once '..'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'init.php';
use \Plugin_classes\Config as Config;
use \Plugin_classes\DB as DBase;

//Logout logic
if(isset($_POST['action']) && !empty($_POST['action'])){
    if(trim($_POST['action']) === 'logout'){
        unset($_SESSION[$_SESSION["CFGURL"]]);
        echo 'SuccessfulLogout';
    }
}

//Login logic
//Add check if the user is already logged in - isset($_SESSION[$_SESSION["CFGURL"]])
if(isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['username']) && !empty('password')){
        $userFullName = '';
        $password = '';
        $userId = '';
        $accessLevel = '';

        $user = DBase::getInstance()->query("select id, NOMBRES, APELLIDO, pass, nivel from pr_usuario where mail = \"" . escape($_POST['username']). "\"");
//        print_r($user);
//        echo '<pre>';
//        print_r($user->results());
//        echo '</pre>';
        if($user->rowsCount() === 1){
            //echo 'User Exists';
            $user = $user->results();
            //print_r($user);
            foreach($user as $row){
                $password = $row->pass;
                $userFullName = $row->NOMBRES.' '.$row->APELLIDO;
                $userId = $row->id;
                $accessLevel = $row->nivel;
            }
            if(escape($_POST['password']) === $password){
                @$_SESSION[$_SESSION["CFGURL"]][ssuser_id]=$userId;
                @$_SESSION[$_SESSION["CFGURL"]][ssuser_nivel]=$accessLevel;
                @$_SESSION[$_SESSION["CFGURL"]][ssuser_nombre]=$userFullName;
                echo 'SuccessfulLogin';
                //echo 'Success!!@@! '.$userFullName;
            }else{
                echo 'Wrong password!';
            }
        }
        //echo trim($_POST['password']);
    }
    if(empty($_POST['password'])){
        echo 'Enter password';
    }
}

/*
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="" method="post">
            <div>
                <input type="text" name="username">
            </div>
            <div>
                <input type="password" name="password">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </body>
</html>

*/
