<?php

session_start();
if(isset($_SESSION["nome"])) {
    session_destroy();
    header("location: /Loucademia/home.php");
    exit();
}

?>