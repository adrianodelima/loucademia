<?php
class TreinoUsuario{

    private $id_usuario;
    private $id_treino;
    private $carga;
    private $qtd_repeticao;
    private $serie;

    public function __construct($id_usuario, $id_treino, $carga, $qtd_repeticao, $serie)
    {
        $this->id_usuario=$id_usuario;
        $this->id_treino=$id_treino;
        $this->carga=$carga;
        $this->qtd_repeticao=$qtd_repeticao;
        $this->serie=$serie;
    }

    public function getIdUsuario() {return $this->id_usuario;}
    public function setIdUsuario($id_usuario) {$this->id_usuario = $id_usuario;}

    public function getIdTreino() {return $this->id_treino;}
    public function setIdTreino($id_treino) {$this->id_treino = $id_treino;}
    
    public function getCarga() {return $this->carga;}
    public function setCarga($carga) {$this->carga = $carga;}

    public function getQtdRepeticao() {return $this->qtd_repeticao;}
    public function setQtdRepeticao($qtd_repeticao) {$this->qtd_repeticao = $qtd_repeticao;}

    public function getSerie() {return $this->serie;}
    public function setSerie($serie) {$this->serie = $serie;}
}
?>