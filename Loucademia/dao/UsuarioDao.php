<?php
interface UsuarioDao {

    public function insereUsuario($usuario);
    public function inativaUsuario($id, $tipo);
    public function reativaUsuario($id, $login);
    public function alteraUsuario(&$usuario);
    public function alteraSenhaPendente($id, $login, $senha);
    public function alteraSenhaAntigaNovaUsuario($id, $login, $senha_nova);
    public function buscaPorIdUsuario($id);
    public function buscaPorLoginUsuario($login);
    public function buscaPorNomeEmailUsuarios($nome_email);
    public function buscaPorNomeLoginUsuariosAtivos($nome_login);
    public function buscaTodosUsuariosInstrutores();
    public function buscaTodosUsuariosAtivos();
    public function buscaTodosUsuariosPendentes();
    public function buscaTodosUsuariosInativos();
    public function buscaTodosUsuarios();
}
?>