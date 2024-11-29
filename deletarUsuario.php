<?php
include_once "./config/config.php";
include_once "./classes/Usuario.php";

session_start();
if (isset($_SESSION["id"])) {
    header('Location: gerenciarUsuario.php');
    exit();
}

$usuario = new Usuario($db);
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $usuario->deletar($id);
    header('Location: gerenciarUsuario.php');
    exit();
}

?>