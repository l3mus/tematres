<?php
//session_start();
//echo 'Init included';
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'tematres'
    )
);

spl_autoload_register(function($class){
    //require_once '../plugins/Plugin_classes/'.$class.'.php'; //the path depends on the calling file location - in this case user_menu_test/prototype.php
    //require_once '..'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$class.'.php';
    require_once '..'.DIRECTORY_SEPARATOR.$class.'.php'; //This path works only for files located in tempFunctionality folder
    //require_once '..' . DIRECTORY_SEPARATOR . 'Plugin_classes' . DIRECTORY_SEPARATOR . $class . '.php';
}, $throw = true, $prepend = true);

//spl_autoload_register(function($className){
//    $className = ltrim($className, '\\');
//    $fileName = '';
//    $namespace = '';
//    if($lastNsPos = strrpos($className, '\\')){ //find the last occurrence
//        $namespace = substr($className, 0, $lastNsPos);
//        $className = substr($className, $lastNsPos + 1);
//        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
//    }
//    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
//    require_once $fileName;
//    //echo $fileName;
//});

//require_once 'functions/sanitize.php'; //check the path!!!