<?php

include_once('TreinoDao.php');
include_once('PostgresDao.php');

class PostgresTreinoDao extends PostgresDao implements TreinoDao {

    private $table_name = 'treino';

    public function insereTreino($treino) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, id_instrutor) VALUES" .
        " (:nome, :id_instrutor)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", $treino->getNome());
        $stmt->bindValue(":id_instrutor", $treino->getIdInstrutor());

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function removeTreino($id) {

        $query = "DELETE FROM " . $this->table_name .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function alteraTreino(&$treino) {

        $query = "UPDATE " . $this->table_name . 
                   " SET nome = :nome, id_instrutor = :id_instrutor" .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", $treino->getNome());
        $stmt->bindValue(":id_instrutor", $treino->getIdInstrutor());
        $stmt->bindValue(":id", $treino->getId());

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorIdTreino($id) {

        $treino = null;

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $treino = new Treino($row['id'], $row['nome'], $row['id_instrutor']);
        }

        return $treino;
    }

    public function buscaPorNomeTreino($nome) {

        $treinos = array();

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE nome like :nome";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", '%' . $nome . '%');

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $treinos[] = new Treino($id, $nome, $id_instrutor);
        }

        return $treinos;
    }
    
    public function buscaTodosTreinos() {

        $treinos = array();

        $query = "SELECT *
                    FROM " . $this->table_name . 
                 " ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $treinos[] = new Treino($id, $nome, $id_instrutor);
        }

        return $treinos;
    }
}