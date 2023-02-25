<?php
interface AcessoDao {

    public function insereEntrada($id_usuario);
    public function insereSaida(&$id_usuario);
    public function buscaAcessoMaisRecente($id_usuario);
    public function buscaTodosAcessos($id_usuario);
    public function buscaPorDataAcessos($data_considerar);
}
?>