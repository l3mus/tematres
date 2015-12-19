<?php
namespace Plugin_classes;
class DB{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;
    private function __construct(){
        try{
            $this->_pdo = new \PDO('mysql:host='. Config::get('mysql/host') .';dbname='. Config::get('mysql/db') , Config::get('mysql/username'), Config::get('mysql/password'));
            //echo 'Connected!';
        }catch(\PDOException $e){
            exit($e->getMessage());
        }
    }
    public static function getInstance(){ //single tone pattern
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    public function query($sql, $params = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()){ //this will fail only if we have wrong query, but not if the result is empty - for example wrong table name is an error but looking for non-existing value is not an error
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ); //To check if the value exists always check if $_count > 0 !!!
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;
    }
    public function error(){
        return $this->_error;
    }
    public function rowsCount(){
        return $this->_count;
    }
    public function results(){
        return $this->_results;
    }
    public static function test(){
        echo 'Test from DB';
    }
}