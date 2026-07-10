<?php
class Database{
    private $host = "mysql:host=localhost;dbname=placement_db";
    // private $dbname = "placement_db";
    private $username = "root";
    private $psw ="";

    public $conn;

    public function connect(){
        $this->conn = null;

        try{

        $this->conn = new PDO($this->host,$this->username,$this->psw);
        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION,
        );

        return $this->conn;
        }
        catch(PDOException $e){
            die("Connection Failed: ".$e->getMessage());
        }
    } 
}

?>