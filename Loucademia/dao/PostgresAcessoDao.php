<?php

include_once('AcessoDao.php');
include_once('PostgresDao.php');

class PostgresAcessoDao extends PostgresDao implements AcessoDao{

    private $table_name = 'acesso';

    public function insereEntrada($id_usuario) {

        $query = "INSERT INTO " . $this->table_name . 
        " (id_usuario, entrada) VALUES" .
        " (:id_usuario, current_timestamp)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        if($stmt->execute()){
            return true; 
        }

        return false;
    }

    public function insereSaida(&$id_usuario) {

        $query = "UPDATE acesso" .
                   " SET saida = current_timestamp" .
                 " WHERE id_usuario = :id_usuario" .
                   " AND entrada = (select max(ace.entrada)
                                      from acesso ace
                                     where ace.id_usuario = acesso.id_usuario)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaAcessoMaisRecente($id_usuario) {

        $acesso = null;

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE id_usuario = :id_usuario" . 
                   " AND entrada = (select max(ace.entrada)
                                      from acesso ace
                                     where ace.id_usuario = acesso.id_usuario)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $acesso = new Acesso($row['id_usuario'], $row['entrada'], $row['saida']);
        }

        return $acesso;
    }

    public function buscaTodosAcessos($id_usuario) {

        $acessos = array();

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE id_usuario = :id_usuario" .
                 " ORDER BY entrada";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $acessos[] = new Acesso($id_usuario, $entrada, $saida);
        }

        return $acessos;
    }

    public function buscaPorDataAcessos($data_considerar) {

        $acessos = array();

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE (date(entrada) = :data_considerar
                      OR date(saida) = :data_considerar)      
                   ORDER BY entrada";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":data_considerar", $data_considerar);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $acessos[] = new Acesso($id_usuario, $entrada, $saida);
        }

        return $acessos;
    }
}
?>