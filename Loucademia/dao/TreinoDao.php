<?php
interface TreinoDao {

    public function insereTreino($treino);
    public function removeTreino($id);
    public function alteraTreino(&$treino);
    public function buscaPorIdTreino($id);
    public function buscaPorNomeTreino($nome);
    public function buscaTodosTreinos();
}
?>