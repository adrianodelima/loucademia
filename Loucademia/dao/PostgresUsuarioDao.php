<?php

include_once('UsuarioDao.php');
include_once('PostgresDao.php');

class PostgresUsuarioDao extends PostgresDao implements UsuarioDao {

    private $table_name = 'usuario';

    public function insereUsuario($usuario) {

        $query = "INSERT INTO " . $this->table_name . 
        " (login, senha, nome, cpf, datanascimento, sexo, email, telefone, situacao, tipo, rua, numero, complemento, estado, cidade, cep) VALUES" .
        " (:login, :senha, :nome, :cpf, :datanascimento, :sexo, :email, :telefone, :situacao, :tipo, :rua, :numero, :complemento, :estado, :cidade, :cep)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":login", $usuario->getLogin());
        $stmt->bindValue(":senha", md5($usuario->getLogin().$usuario->getSenha()));
        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":cpf", $usuario->getCpf());
        $stmt->bindValue(":datanascimento", $usuario->getDataNascimento());
        $stmt->bindValue(":sexo", $usuario->getSexo());
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":telefone", $usuario->getTelefone());
        $stmt->bindValue(":situacao", $usuario->getSituacao());
        $stmt->bindValue(":tipo", $usuario->getTipo());
        $stmt->bindValue(":rua", $usuario->getEndereco()->getRua());
        $stmt->bindValue(":numero", $usuario->getEndereco()->getNumero());
        $stmt->bindValue(":complemento", $usuario->getEndereco()->getComplemento());
        $stmt->bindValue(":estado", $usuario->getEndereco()->getEstado());
        $stmt->bindValue(":cidade", $usuario->getEndereco()->getCidade());
        $stmt->bindValue(":cep", $usuario->getEndereco()->getCep());
        
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function inativaUsuario($id, $tipo) {

        if($tipo == 'instrutor'){
            $query = "SELECT count(*)" .
                      " FROM treino " .
                     " WHERE id_instrutor = :id_instrutor";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":id_instrutor", $id);

            $stmt->execute();

            $count = $stmt->fetchColumn();

            if($count > 0){
                return false;
            }
        }

        $query = "SELECT count(*)" .
                  " FROM treino_usuario " .
                 " WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id_usuario", $id);

        $stmt->execute();

        $count = $stmt->fetchColumn();

        if($count > 0){
            return false;
        }

        try{
            $stmt = $this->conn->beginTransaction();

            $query = "UPDATE " . $this->table_name .
                       " SET situacao = 'inativo'" .
                     " WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":id", $id);

            if($stmt->execute()){
                $query = "DELETE FROM acesso" .
                         " WHERE id_usuario = :id_usuario " . 
                           " AND saida is null";

                $stmt = $this->conn->prepare($query);

                $stmt->bindValue(":id_usuario", $id);

                $stmt->execute();
            }
            $stmt = $this->conn->commit();

            return true;

        }catch (Exception $e){

            $stmt = $this->conn->rollBack();

            return false;
        }
    }

    public function reativaUsuario($id, $login) {

        $query = "UPDATE " . $this->table_name .
                   " SET senha = :senha,
                         situacao = 'pendente'" .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":senha", md5($login.$login));
        $stmt->bindValue(":id", $id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function alteraUsuario(&$usuario) {

        $query = "UPDATE " . $this->table_name . 
                   " SET login = :login, nome = :nome, cpf = :cpf, datanascimento = :datanascimento, sexo = :sexo," .
                       " email = :email, telefone = :telefone, rua = :rua, numero = :numero, complemento = :complemento," .
                       " cep = :cep" .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":login", $usuario->getLogin());
        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":cpf", $usuario->getCpf());
        $stmt->bindValue(":datanascimento", $usuario->getDataNascimento());
        $stmt->bindValue(":sexo", $usuario->getSexo());
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":telefone", $usuario->getTelefone());
        $stmt->bindValue(":rua", $usuario->getEndereco()->getRua());
        $stmt->bindValue(":numero", $usuario->getEndereco()->getNumero());
        $stmt->bindValue(":complemento", $usuario->getEndereco()->getComplemento());
        $stmt->bindValue(":cep", $usuario->getEndereco()->getCep());
        $stmt->bindValue(":id", $usuario->getId());

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function alteraSenhaPendente($id, $login, $senha) {

        $query = "UPDATE " . $this->table_name . 
                   " SET senha = :senha," .
                       " situacao = 'ativo'" .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":senha", md5($login.$senha));
        $stmt->bindValue(":id", $id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function alteraSenhaAntigaNovaUsuario($id, $login, $senha_nova) {
        $query = "UPDATE " . $this->table_name . 
                   " SET senha = :senha" .
                 " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":senha", md5($login.$senha_nova));
        $stmt->bindValue(":id", $id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorIdUsuario($id) {

        $usuario = null;

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $endereco = new Endereco($row['rua'], $row['numero'], $row['complemento'], $row['estado'], $row['cidade'], $row['cep']);
            $usuario = new Usuario($row['id'], $row['login'], $row['senha'], $row['nome'], $row['cpf'], $row['datanascimento'], $row['sexo'], $row['email'], $row['telefone'], $row['situacao'], $row['tipo'], $endereco);
        }

        return $usuario;
    }

    public function buscaPorLoginUsuario($login) {

        $usuario = null;

        $query = "SELECT *
                    FROM " . $this->table_name . "
                   WHERE login = :login";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":login", $login);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $endereco = new Endereco($row['rua'], $row['numero'], $row['complemento'], $row['estado'], $row['cidade'], $row['cep']);
            $usuario = new Usuario($row['id'], $row['login'], $row['senha'], $row['nome'], $row['cpf'], $row['datanascimento'], $row['sexo'], $row['email'], $row['telefone'], $row['situacao'], $row['tipo'], $endereco);
        }

        return $usuario;
    }

    public function buscaPorNomeEmailUsuarios($nome_email) {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name . 
                 " WHERE nome like :nome " .
                 "    OR email like :email " .
                 " ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", '%' . $nome_email . '%');
        $stmt->bindValue(":email", '%' . $nome_email . '%');

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaPorNomeLoginUsuariosAtivos($nome_login) {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name . 
                 " WHERE (nome like :nome " .
                    " OR login like :login) " .
                   " AND situacao = 'ativo'" .
                 " ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", '%' . $nome_login . '%');
        $stmt->bindValue(":login", '%' . $nome_login . '%');

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaTodosUsuariosInstrutores() {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name . 
                 " WHERE tipo = 'instrutor'" .
                   " AND situacao = 'ativo'" .
                 " ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaTodosUsuariosAtivos() {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE situacao = 'ativo'
                   ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaTodosUsuariosPendentes() {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE situacao = 'pendente'
                   ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaTodosUsuariosInativos() {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name .
                 " WHERE situacao = 'inativo'
                   ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }

    public function buscaTodosUsuarios() {

        $usuarios = array();

        $query = "SELECT *
                    FROM " . $this->table_name . 
                 " ORDER BY nome";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
            $usuarios[] = new Usuario($id, $login, $senha, $nome, $cpf, $datanascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);
        }

        return $usuarios;
    }
}
?>