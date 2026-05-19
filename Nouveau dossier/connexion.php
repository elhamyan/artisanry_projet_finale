<?php 
class Database{
    private $host='localhost';
    private $dbname='artisanry';
    private $username='root';
    private $password='';

    public function getConnection(){
        try{
            return new PDO( "mysql:host=$this->host;dbname=$this->dbname",
             $this->username, $this->password);
        }catch(PDOException $e){
            echo"Errore:".$e->getMessage();

        }
    }
}