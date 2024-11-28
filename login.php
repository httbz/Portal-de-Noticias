<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';


$usuario = new Usuario($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['id'];
            header('Location: portal.php');
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style_login.css">
<link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

<head>
    <title>A U T E N T I C A Ç Ã O</title>

</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Notícias</h1>
        <a href="index.php" class="btn-voltar">Voltar</a>
    </header>
    <main>
        <div class="container">
            <div class="box">
                <h1>A U T E N T I C A Ç Ã O</h1>
                <form method="POST">
                    <input type="email" name="email" required class="control" placeholder="E-mail">
                    <br><br>
                    <input type="password" name="senha" required class="control" placeholder="Senha">
                    <br><br>
                    <a href="registrar.php" class="btn-cad">Registrar-se</a>
                    <input type="submit" name="login" value="Login" class="btn">
                </form>
                <div class="mensagem">
                    <?php if (isset($mensagem_erro))
                        echo '<p>' . $mensagem_erro . '</p>'; ?>
                </div>
            </div>
    </main>
</body>

</html>