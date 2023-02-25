<?php
interface PagamentoDao {

    public function inserePagamento($pagamento);
    public function buscaUltimoMesPagamento($id_usuario);
    public function buscaUltimoAnoPagamento($id_usuario);
}
?>