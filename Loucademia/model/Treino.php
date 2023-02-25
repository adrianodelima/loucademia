<?php
class Treino{

    private $id;
    private $nome;
    private $id_instrutor;

    public function __construct($id, $nome, $id_instrutor)
    {
        $this->id=$id;
        $this->nome=$nome;
        $this->id_instrutor=$id_instrutor;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getNome() {return $this->nome;}
    public function setNome($nome) {$this->nome = $nome;}

    public function getIdInstrutor() {return $this->id_instrutor;}
    public function setIdInstrutor($id_instrutor) {$this->id_instrutor = $id_instrutor;}
}
?>