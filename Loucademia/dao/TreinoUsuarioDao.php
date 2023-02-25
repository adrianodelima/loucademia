<?php
interface TreinoUsuarioDao {

    public function insereTreinoUsuario($treinoUsuario);
    public function removeTreinoUsuario($id_usuario, $id_treino);
    public function alteraTreinoUsuario(&$treinoUsuario, $id_treino_antigo);
    public function buscaNomeTreinoUsuario($id_usuario, $nome_treino);
    public function buscaTodosTreinosUsuario($id_usuario);
    public function buscaTodosTreinosTodosUsuariosQuantidade();
    public function buscaTodosTreinosNomeUsuarioQuantidade($nome);
    public function buscaUmTreinoUsuario($id_usuario, $id_treino);
}
?>