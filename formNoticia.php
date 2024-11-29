<?php
    session_start();
    include_once("./config/config.php");
    include_once("./classes/Noticia.php");
    include_once("./classes/Usuario.php");
 
    $usuarios = new Usuario($db);
    $usuarios = $usuarios->ler();
    try {
      $noticia = new Noticia($db);
      $noticia = $noticia -> listarNoticias();  
    } catch (Exception $e) {
        die("Erro: ".$e -> getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Noticia</title>
    <link rel="stylesheet" href="style_formNot.css">
</head>

<body>
    <header>
    <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Notícias</h1>
        <a href="gerenciarNoticia.php" class="btn-voltar">Voltar</a>
    </header>

    <div class="container">
        <h1 class="title-not">Adicionar Novas Notícias</h1>
        <form action="salvarnoticias.php" method="post" enctype="multipart/form-data">

            <label for="">Titulo</label><br>
            <input type="text" name="titulo" required class="control"><br><br>

            <label for="">Autor</label><br>
            <select name="autor" required class="control">
                <option value="">Selecione o Autor</option>
                <?php foreach($usuarios as $usuario) : ?>
                    <option value="<?php echo $usuario['id']; ?>"><?php echo htmlspecialchars($usuario['nome']); ?></option>
                    <?php endforeach; ?>
            </select><br><br>

            <label for="">Data de Publicação</label><br>
            <input type="date" name="data_publicacao" required class="control"><br><br>

            <label for="">Notícia</label><br>
            <textarea name="conteudo" rows="5" required class="control"></textarea><br><br>

            <label for="">Image</label><br>
            <input type="file" name="imagem" accept=".jpg, .png"><br><br>

            <button type="submit" class="btn">Salvar Notícia</button><br>
        </form>
    </div>
</body>

</html>