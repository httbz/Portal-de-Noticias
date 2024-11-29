<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticia.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$noticia = new Noticia($db);

// Obter ID da notícia a ser editada
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID da notícia não fornecido.");
}

$dadosNoticia = $noticia->lerPorIdNoticia($id);
if (!$dadosNoticia) {
    die("Notícia não encontrada.");
}

// Processar a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $conteudo = $_POST['conteudo'];
    $data_publicacao = $_POST['data_publicacao'];

    $imagem = $_FILES['imagem'];
    $nomeImagem = $dadosNoticia['imagem']; // Usar imagem existente como padrão

    // Verificar se uma nova imagem foi enviada
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
        $tiposPermitidos = ['jpg', 'jpeg', 'png'];
        if (!in_array($extensao, $tiposPermitidos)) {
            die("Apenas arquivos jpg ou png são permitidos.");
        }

        $nomeImagem = uniqid() . '.' . $extensao;
        $destino = 'uploads/' . $nomeImagem;

        if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
            die("Erro ao salvar a imagem.");
        }
    }

    $noticia->atualizarNoticia($id, $titulo, $autor, $conteudo, $nomeImagem, $data_publicacao);

    header("Location: gerenciarNoticia.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_formNot.css">
    <title>Editar Notícia</title>
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Notícias</h1>
        <a href="gerenciarNoticia.php" class="btn-voltar">Voltar</a>
    </header>
    <main>
        <div class="container">
            <h1 class="title">Editar Notícia</h1>
            <form method="POST" enctype="multipart/form-data">
                <label>Título:</label><br>
                <input class="control" type="text" name="titulo" value="<?php echo htmlspecialchars($dadosNoticia['titulo']); ?>"
                    required><br><br>

                <label>Autor:</label><br>
                <input class="control" type="text" name="autor" value="<?php echo htmlspecialchars($dadosNoticia['autor']); ?>"
                    required><br><br>

                <label>Conteúdo:</label><br>
                <textarea class="control" name="conteudo"
                    required><?php echo htmlspecialchars($dadosNoticia['conteudo']); ?></textarea><br><br>

                <label>Data de Publicação:</label><br>
                <input class="control" type="date" name="data_publicacao"
                    value="<?php echo htmlspecialchars($dadosNoticia['data_publicacao']); ?>" required><br><br>

                <label>Imagem:</label><br>
                <input type="file" name="imagem"><br><br>
                <img src="./uploads/<?php echo htmlspecialchars($dadosNoticia['imagem']); ?>" alt="Imagem da notícia"
                    width="200"><br><br>

                <input type="submit" value="Salvar Alterações" class="btn">
            </form>
        </div>
    </main>
</body>

</html>