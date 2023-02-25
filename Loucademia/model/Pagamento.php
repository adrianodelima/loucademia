<?php
class Pagamento{

    private $id_usuario;
    private $data_pagamento;
    private $valor;

    public function __construct($id_usuario, $data_pagamento, $valor)
    {
        $this->id_usuario=$id_usuario;
        $this->data_pagamento=$data_pagamento;
        $this->valor=$valor;
    }

    public function getIdUsuario() {return $this->id_usuario;}
    public function setIdUsuario($id_usuario) {$this->id_usuario = $id_usuario;}

    public function getDataPagamento() {return $this->data_pagamento;}
    public function setDataPagamento($data_pagamento) {$this->data_pagamento = $data_pagamento;}

    public function getValor() {return $this->valor;}
    public function setValor($valor) {$this->valor = $valor;}
}
?>