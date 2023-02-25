<?php

include_once('PagamentoDao.php');
include_once('PostgresDao.php');

class PostgresPagamentoDao extends PostgresDao implements PagamentoDao {

    private $table_name = 'pagamento';

    public function inserePagamento($pagamento) {
        $query = "INSERT INTO " . $this->table_name . 
        " (id_usuario, valor) VALUES" .
        " (:id_usuario, :valor)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $pagamento->getIdUsuario());
        $stmt->bindValue(":valor", $pagamento->getValor());

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaUltimoMesPagamento($id_usuario) {

        $ultimo_mes = null;

        $query = "SELECT extract (month from max(data_pagamento))
                    FROM " . $this->table_name . "
                   WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        $stmt->execute();

        $ultimo_mes = $stmt->fetchColumn();

        return $ultimo_mes;
    }

    public function buscaUltimoAnoPagamento($id_usuario) {

        $ultimo_mes = null;

        $query = "SELECT extract (year from max(data_pagamento))
                    FROM " . $this->table_name . "
                   WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id_usuario);

        $stmt->execute();

        $ultimo_ano = $stmt->fetchColumn();

        return $ultimo_ano;
    }
}