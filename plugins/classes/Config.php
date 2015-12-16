<?php
class Config{
    public static  function get($path = null){ //Needs check if $path exists
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach($path as $bit){
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false; //this will return false only if $path is empty - see first comment
    }
}