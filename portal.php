<?php
session_start();
include_once './config/config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_portal.css">
    <title>Portal</title>
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Administração</h1>
        <?php echo '<a href="logout.php?token='.md5(session_id()).'" class="btn-sair">Sair</a>' ?>
    </header>
    <main>
        <div class="container">
            <h1 class="title-container">Bem-vindo ao Portal de Administração</h1>
            <div class="actions">
                <a href="gerenciarUsuario.php" class="btn">Gerenciar Usuários</a>
                <a href="gerenciarNoticia.php" class="btn">Gerenciar Notícias</a>
            </div>
        </div>
    </main>
</body>

</html>
