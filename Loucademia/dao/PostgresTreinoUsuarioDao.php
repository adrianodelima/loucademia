<?php

include_once('TreinoUsuarioDao.php');
include_once('PostgresDao.php');

class PostgresTreinoUsuarioDao extends PostgresDao implements TreinoUsuarioDao {

    private $table_name = 'treino_usuario';

    public function insereTreinoUsuario($treinoUsuario) {

        $query = "INSERT INTO " . $this->table_name . 
        " (id_usuario, id_treino, carga, qtd_repeticao, serie) VALUES" .
        " (:id_usuario, :id_treino, :carga, :qtd_repeticao, :serie)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $treinoUsuario->getIdUsuario());
        $stmt->bindValue(":id_treino", $treinoUsuario->getIdTreino());
        $stmt->bindValue(":carga", $treinoUsuario->getCarga());
        $stmt->bindValue(":qtd_repeticao", $treinoUsuario->getQtdRepeticao());
        $stmt->bindValue(":serie", $treinoUsuario->getSerie());

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function removeTreinoUsuario($id_usuario, $id_treino) {

        $query = "DELETE FROM " . $this->table_name .
                 " WHERE id_usuario = :id_usuario" .
                   " AND id_treino = :id_treino";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);
        $stmt->bindValue(":id_treino", $id_treino);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function alteraTreinoUsuario(&$treinoUsuario, $id_treino_antigo) {

        $query = "UPDATE " . $this->table_name . 
                   " SET id_treino = :id_treino, carga = :carga, qtd_repeticao = :qtd_repeticao, serie = :serie" .
                 " WHERE id_usuario = :id_usuario
                     AND id_treino = :id_treino_antigo";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_treino", $treinoUsuario->getIdTreino());
        $stmt->bindValue(":carga", $treinoUsuario->getCarga());
        $stmt->bindValue(":qtd_repeticao", $treinoUsuario->getQtdRepeticao());
        $stmt->bindValue(":serie", $treinoUsuario->getSerie());
        $stmt->bindValue(":id_usuario", $treinoUsuario->getIdUsuario());
        $stmt->bindValue(":id_treino_antigo", $id_treino_antigo);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaNomeTreinoUsuario($id_usuario, $nome_treino) {

        $treinosUsuario = array();

        $query = "SELECT id
                    FROM treino
                   WHERE nome like :nome";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", '%' . $nome_treino . '%');

        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $treino){
            $query = "SELECT *
                        FROM " . $this->table_name . "
                       WHERE id_usuario = :id_usuario
                         AND id_treino = :id_treino";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":id_usuario", $id_usuario);
            $stmt->bindValue(":id_treino", $treino['id']);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row) {
                $treinosUsuario[] = new TreinoUsuario($row['id_usuario'], $row['id_treino'], $row['carga'], $row['qtd_repeticao'], $row['serie']);
            }
        }

        return $treinosUsuario;
    }

    public function buscaTodosTreinosUsuario($id_usuario) {

        $treinosUsuario = array();

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $treinosUsuario[] = new TreinoUsuario($id_usuario, $id_treino, $carga, $qtd_repeticao, $serie);
        }

        return $treinosUsuario;
    }

    public function buscaTodosTreinosTodosUsuariosQuantidade() {

        $treinosQuantidade = array();

        $query = "SELECT usuario.id, usuario.nome, count(*) quantidade
                    FROM usuario, " . $this->table_name .
                 " WHERE usuario.id = " . $this->table_name . ".id_usuario " .
                 " GROUP BY usuario.id, usuario.nome " .
                 " ORDER BY usuario.id ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $treinosQuantidade[] = $row;
        }

        return $treinosQuantidade;
    }

    public function buscaTodosTreinosNomeUsuarioQuantidade($nome) {

        $treinosQuantidade = array();

        $query = "SELECT usuario.id, usuario.nome, count(*) quantidade
                    FROM usuario, " . $this->table_name .
                 " WHERE usuario.id = " . $this->table_name . ".id_usuario " .
                 "   AND usuario.nome like :nome " .
                 " GROUP BY usuario.id, usuario.nome " .
                 " ORDER BY usuario.id ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", '%' . $nome . '%');

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $treinosQuantidade[] = $row;
        }

        return $treinosQuantidade;
    }

    public function buscaUmTreinoUsuario($id_usuario, $id_treino) {

        $treinoUsuario = null;

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE id_usuario = :id_usuario
                     AND id_treino = :id_treino";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);
        $stmt->bindValue(":id_treino", $id_treino);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $treinoUsuario = new TreinoUsuario($row['id_usuario'], $row['id_treino'], $row['carga'], $row['qtd_repeticao'], $row['serie']);
        }

        return $treinoUsuario;
    }
}
?>