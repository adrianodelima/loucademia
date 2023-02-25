<?php
class Usuario{

    private $id;
    private $login;
    private $senha;
    private $nome;
    private $cpf;
    private $dataNascimento;
    private $sexo;
    private $email;
    private $telefone;
    private $situacao;
    private $tipo;
    private $Endereco;

    public function __construct($id, $login, $senha, $nome, $cpf, $dataNascimento, $sexo, $email, $telefone, $situacao, $tipo, $Endereco) 
    {
        $this->id=$id;
        $this->login=$login;
        $this->senha=$senha;
        $this->nome=$nome;
        $this->cpf=$cpf;
        $this->dataNascimento = $dataNascimento;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->situacao = $situacao;
        $this->tipo = $tipo;
        $this->Endereco = $Endereco;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getLogin() {return $this->login;}
    public function setLogin($login) {$this->login = $login;}

    public function getSenha() {return $this->senha;}
    public function setSenha($senha) {$this->senha = $senha;}

    public function getNome() {return $this->nome;}
    public function setNome($nome) {$this->nome = $nome;}

    public function getCpf() {return $this->cpf;}
    public function setCpf($cpf) {$this->cpf = $cpf;}

    public function getDataNascimento() {return $this->dataNascimento;}
    public function setDataNascimento($dataNascimento) {$this->dataNascimento = $dataNascimento;}

    public function getSexo() {return $this->sexo;}
    public function setSexo($sexo) {$this->sexo = $sexo;}

    public function getEmail() {return $this->email;}
    public function setEmail($email) {$this->email = $email;}

    public function getTelefone() {return $this->telefone;}
    public function setTelefone($telefone) {$this->telefone = $telefone;}

    public function getSituacao() {return $this->situacao;}
    public function setSituacao($situacao) {$this->situacao = $situacao;}

    public function getTipo() {return $this->tipo;}
    public function setTipo($tipo) {$this->tipo = $tipo;}

    public function getEndereco() { return $this->Endereco;}
    public function setEndereco($Endereco) {$this->Endereco = $Endereco;}
}
?>