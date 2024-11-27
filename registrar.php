<?php
include_once './config/config.php';
include_once './classes/Usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->criar($nome, $sexo, $fone, $email, $senha);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="style_cad.css">
</head>
<header>
    <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
    <h1 class="title">Portal de Notícias</h1>
    <a href="login.php" class="btn-voltar">Voltar</a>
</header>

<body>
    <main>
        <div class="container">
            <h1>Adicionar Usuário</h1>
            <form method="POST">
                <input type="text" name="nome" required class="control" placeholder="Nome...">
                <br><br>
                <label>Sexo:</label>
                <label for="masculino">
                    <input type="radio" id="masculino" name="sexo" value="M" required class="ball"> Masculino
                </label>
                <label for="feminino">
                    <input type="radio" id="feminino" name="sexo" value="F" required class="ball"> Feminino
                </label>
                <br><br>
                <input type="text" name="fone" required class="control" placeholder="Telefone...">
                <br><br>
                <input type="email" name="email" required class="control" placeholder="E-Mail...">
                <br><br>
                <input type="password" name="senha" required class="control" placeholder="Senha...">
                <br><br>
                <input type="submit" value="Adicionar" class="btn">
            </form>
        </div>
    </main>
</body>

</html>