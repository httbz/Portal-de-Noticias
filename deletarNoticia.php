<?php
include_once "./config/config.php";
include_once "./classes/Noticia.php";

session_start();
if (isset($_SESSION["id"])) {
    header('Location: gerenciarNoticia.php');
    exit();
}


$noticia = new Noticia($db);
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $noticia->deletarNoticia($id);
    header('Location: gerenciarNoticia.php');
    echo 'Notícia deletado!';
    exit();
}

?>