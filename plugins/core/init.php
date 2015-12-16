<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'db' => 'tematres'
    )
);

spl_autoload_register(function($class){
    require_once '../classes/'.$class.'.php'; //the path depends on the calling file location - in this case user_menu_test/prototype.php
});

require_once '../functions/sanitize.php';