<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class SiswaEdu{
    protected $db;
    protected $dbname='siswaedu'; 
    public function __construct()
    {
        $a=ServiceAccount::fromJsonFile(__DIR__.'/Secret/tester-428f8-094d4f06ab73.json');
        $firebase = (new Factory)->withServiceAccount($a)->create();
        $this->database=$firebase->getDatabase();
    }

    public function get(int $userID=null){
        if(empty($userID)|| !isset($userID)){
            return false;
        }if($this->database->getReference($this->dbname)->getSnapShot()->hasChild($userID)){
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
        }else{
            return false;
        }
    }

    //Insert
    public function insert(array $data){
        if (empty($data) || !isset($data)) {
            return false;
        }
        foreach ($data as $key => $value) {
            $this->database->getReference($this->dbname)->getChild($key)->set($value);
        }
        return true;
    }
    //Delete
    public function delete(int $userID){
        if (empty($userID) || !isset($userID)) {
            return false;
        }
        if ($this->database->getReference($this->dbname)->getSnapShot()->hasChild($userID)) {
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return false;
        }
        else {
            return false;
        }
    }
}

$siswaedu = new SiswaEdu();
// var_dump($siswaedu->insert([
//     '1'=>'Giant',
//     '2'=>'Suneo',
//     '3'=>'Shizuka'
// ]));

var_dump(($siswaedu->delete(3)));