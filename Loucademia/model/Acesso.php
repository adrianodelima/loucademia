<?php
class Acesso{

    private $id_usuario;
    private $entrada;
    private $saida;

    public function __construct($id_usuario, $entrada, $saida)
    {
        $this->id_usuario=$id_usuario;
        $this->entrada=$entrada;
        $this->saida=$saida;
    }

    public function getIdUsuario() {return $this->id_usuario;}
    public function setIdUsuario($id_usuario) {$this->id_usuario = $id_usuario;}

    public function getEntrada() {return $this->entrada;}
    public function setEntrada($entrada) {$this->entrada = $entrada;}

    public function getSaida() {return $this->saida;}
    public function setSaida($saida) {$this->saida = $saida;}
}