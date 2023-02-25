<?php

include_once('model/Acesso.php');
include_once('model/Endereco.php');
include_once('model/Pagamento.php');
include_once('model/Usuario.php');
include_once('model/Treino.php');
include_once('model/TreinoUsuario.php');

include_once('dao/AcessoDao.php');
include_once('dao/PagamentoDao.php');
include_once('dao/UsuarioDao.php');
include_once('dao/TreinoDao.php');
include_once('dao/TreinoUsuarioDao.php');

include_once('dao/DaoFactory.php');
include_once('dao/PostgresDaoFactory.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$factory = new PostgresDaofactory();

?>