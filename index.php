<?php

include_once './config/config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticia.php';

// Verificar se o usuário está logado

$usuario = new Usuario($db);
$noticia = new Noticia($db);
$dados = $noticia->lerNoticia();//->fetchAll(PDO::FETCH_ASSOC);

// Obter dados do usuário logado
$dados_noticia = $noticia->lerNoticia();
//$titulo_noticia = $dados_noticia['titulo'];
// Obter dados dos usuários


/**/
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

    <title>Portal de Notícias</title>
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1>Portal de Notícias</h1>
        <a href="login.php" class="btn-login">Login</a>
    </header>
    <main>
        <div class="container">
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)):
            $nome = $usuario->lerPorId($row['autor']);
                //formatação da data
                $dataOriginal = $row['data_publicacao'];
                $dataFormatada = DateTime::createFromFormat('Y-m-d', $dataOriginal)->format('d/m/Y'); ?>

                <div class="user-card">
                    <div class="title-not"><?php echo ucfirst($row['titulo']); ?></div>
                    <div><img src="./uploads/<?php echo $row['imagem']; ?>" alt="imagem da notícia" class="img"></div>
                    <div class="autor">Escrito por: <?php  echo $nome['nome']; ?></div>
                    <div class="conteudo"><?php echo $row['conteudo']; ?></div>
                    <div class="data-publicacao"><?php echo $dataFormatada ?></div>
                </div>
            <?php endwhile; ?>
    </main>
</body>

</html>