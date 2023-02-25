<?php

    $path = '/Loucademia/';
    $usuario = $path . 'domain/usuario/';
    $visualiza = $path . 'interfaces/view/';
    $relatorio = $path . 'interfaces/relatorio/';
    $treino = $path . 'domain/treino/';
    $service = $path . 'application/service/';

    $login = $service . 'login.php';
    $logout = $service . 'executa_logout.php';
    $acessos = $path . 'acessos.php';
    $treino_usuario = $path . 'treinos_usuarios.php';
    $pagamento = $path . 'pagamento_pendente.php';
    $usuarios = $path . 'usuarios.php';
    $novo_treino = $treino . 'novo_treino.php';
    $treinos = $path . 'treinos.php';

    $acessos_relatorio = $relatorio . 'relatorio_acessos.php';
    $situacoes_relatorio = $relatorio . 'relatorio_situacoes.php';

    $novo_usuario = $usuario . 'novo_usuario.php';
    $modifica_usuario = $usuario . 'modifica_usuario.php';

    $visualiza_usuario = $visualiza . 'visualiza_usuario.php';    
    $visualiza_treinos_usuario = $visualiza . 'visualiza_treinos_usuario.php'; 

?>

<!DOCTYPE HTML>
<html lang=pt-br>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/Loucademia/css/main.css" />

        <title><?php echo $page_title; ?></title>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <header class="section-header">
            <div class="container-fullwidth">
                <nav class="navbar navbar-expand-lg border-primaria">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/Loucademia/home.php">
                            <img src="/Loucademia/assets/logo-nova.png" style="width: 70px;" alt="logo">
                            <span class="title-logo">Loucademia</span>
                        </a>

                        <button class="navbar-toggler navbar-light" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbar-collapse">
                            <ul class="navbar-nav ml-auto">
                                <?php
                                    include_once "comum.php";
                                    if (is_session_started() === FALSE) {
                                        session_start();
                                    }

                                    if(isset($_SESSION["nome"])) {
                                            echo "<li class='nav-item'>
                                                      <span class='nav-link text-black'>Bem vindo, <b>" . $_SESSION["nome"] . "</b> - <small class='text-muted text-capitalize'>" . $_SESSION["tipo"] . "</small></span>
                                                  </li>
                                                  <li class='nav-item dropdown'>
                                                      <a class='nav-link font-color-primaria dropdown-toggle' data-toggle='dropdown'><b>Meu perfil</b></a>
                                                      <ul class='dropdown-menu dropdown-menu-end'>
                                                          <li><a class='dropdown-item' href=" . $visualiza_usuario . "?id=" . @$_SESSION['id'] . "><b>Visualizar</b></a></li>
                                                          <li><a class='dropdown-item' href=" . $modifica_usuario . "?id=" . @$_SESSION['id'] . "><b>Alterar</b></a></li>
                                                          <li><a class='dropdown-item' href=" . $visualiza_treinos_usuario . "?id=" . @$_SESSION["id"] . "&nome=" . @$_SESSION["nome"] . "><b>Meus treinos</b></a></li>
                                                          <li><a class='dropdown-item' href=" . $pagamento . "?id=" . @$_SESSION["id"] . "><b>Pagar mensalidade</b></a></li>
                                                      </ul>
                                                  </li>";

                                            if($_SESSION["tipo"] == "recepcionista"){
                                              echo "<li class='nav-item dropdown'>
                                                        <a class='nav-link font-color-primaria dropdown-toggle' data-toggle='dropdown'>Usuário</a>
                                                        <ul class='dropdown-menu dropdown-menu-end'>
                                                            <li><a class='dropdown-item' href=" . $novo_usuario . ">Cadastrar</a></li>
                                                            <li><a class='dropdown-item' href=" . $usuarios . ">Consultar</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class='nav-item dropdown'>
                                                        <a class='nav-link font-color-primaria dropdown-toggle' data-toggle='dropdown'>Treino</a>
                                                        <ul class='dropdown-menu dropdown-menu-end'>
                                                            <li><a class='dropdown-item' href=" . $novo_treino . ">Cadastrar</a></li>
                                                            <li><a class='dropdown-item' href=" . $treinos . ">Consultar</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class='nav-item'>
                                                        <a href=" . $treino_usuario . " class='nav-link font-color-primaria'>Treinos usuários</a>
                                                    </li>
                                                    <li class='nav-item'>
                                                        <a href=". $acessos . " class='nav-link font-color-primaria'>Acessos</a>
                                                    </li>
                                                    <li class='nav-item dropdown'>
                                                        <a class='nav-link font-color-primaria dropdown-toggle' data-toggle='dropdown'>Relatórios</a>
                                                        <ul class='dropdown-menu dropdown-menu-end'>
                                                            <li><a class='dropdown-item' href=" . $acessos_relatorio . ">Acessos</a></li>
                                                            <li><a class='dropdown-item' href=" . $situacoes_relatorio . ">Situações</a></li>
                                                        </ul>
                                                    </li>";
                                            }

                                            echo "<li class='nav-item'>
                                                      <a href=" . $logout . " class='nav-link font-color-primaria'><b>Logout</b></a>
                                                  </li>";
                                    } else {
                                           if ($_SERVER['REQUEST_URI'] !=" . $novo_usuario . ") {
                                               echo "<li class='nav-item'>
                                                         <a href=" . $novo_usuario . " class='nav-link font-color-primaria'><b>Quero me cadastrar</b></a>
                                                     </li>";
                                           }

                                           echo "<li class='nav-item'>
                                                     <a href=" . $login . " class='nav-link font-color-primaria'><b>Entrar</b></a>
                                                 </li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>