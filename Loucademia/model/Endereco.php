<?php
class Endereco {
    
    private $rua;
    private $numero;
    private $complemento;
    private $estado;
    private $cidade;
    private $cep;

    public function __construct($rua, $numero, $complemento, $estado, $cidade, $cep) 
    {
        $this->rua=$rua;
        $this->numero=$numero;
        $this->complemento=$complemento;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->cep = $cep;
    }

    public function getRua() {return $this->rua;}
    public function setRua($rua) {$this->rua = $rua;}

    public function getNumero() {return $this->numero;}
    public function setNumero($numero) {$this->numero = $numero;}

    public function getComplemento() {return $this->complemento;}
    public function setComplemento($complemento) {$this->complemento = $complemento;}

    public function getCidade() {return $this->cidade;}
    public function setCidade($cidade) {$this->cidade = $cidade;}

    public function getEstado() {return $this->estado;}
    public function setEstado($estado) {$this->estado = $estado;}

    public function getCep() {return $this->cep;}
    public function setCep($cep) {$this->cep = $cep;}
}
?>