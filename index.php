<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticia.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
$usuario = new Usuario($db);
$noticia = new Noticia($db);
$dados = $noticia->lerNoticia();//->fetchAll(PDO::FETCH_ASSOC);

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

    // Obter dados do usuário logado
    $dados_noticia = $noticia->lerPorIdNoticia($_SESSION['usuario_id']);
    $titulo_noticia = $dados_noticia['titulo'];
    // Obter dados dos usuários


}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <title>Portal de Noícias</title>
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1>Portal de Notícias</h1>
        <a href="login.php" class="btn-login">Login</a>
    </header>
    <main>
        <div class="container">
            <a href="formNoticia.php" class="btn">Criar Notícia</a>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="container">
                    <h1><?php echo $row['titulo']; ?></h1>
                    <img src="./uploads/<?php echo $row['nomeImagem']; ?>" alt="">
                </div>

            <?php endwhile; ?>
        </div>
    </main>
</body>

</html>