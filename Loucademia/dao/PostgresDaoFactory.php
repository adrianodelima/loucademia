<?php

include_once('DaoFactory.php');
include_once('PostgresAcessoDao.php');
include_once('PostgresPagamentoDao.php');
include_once('PostgresUsuarioDao.php');
include_once('PostgresTreinoUsuarioDao.php');
include_once('PostgresTreinoDao.php');

class PostgresDaofactory extends DaoFactory {

    private $username = "postgres";
    private $password = "postgres";
    public $conn;

    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("pgsql:host=localhost;port=5432;dbname=loucademia", $this->username, $this->password);
    
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getAcessoDao() {

        return new PostgresAcessoDao($this->getConnection());

    }

    public function getPagamentoDao() {

        return new PostgresPagamentoDao($this->getConnection());

    }

    public function getUsuarioDao() {

        return new PostgresUsuarioDao($this->getConnection());

    }

    public function getTreinoDao() {

        return new PostgresTreinoDao($this->getConnection());

    }

    public function getTreinoUsuarioDao() {

        return new PostgresTreinoUsuarioDao($this->getConnection());

    }
}
?>