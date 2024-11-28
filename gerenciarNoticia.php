<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticia.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

$noticia = new Noticia($db);
$noticias = $noticia->listarNoticias();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $noticia->deletarNoticia($_POST['id']);
        header("Location: gerenciarNoticia.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Notícias</title>
    <link rel="stylesheet" href="style_gNoticia.css">
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Gerenciar Notícias</h1>
        <a href="portal.php" class="btn-voltar">Voltar</a>
    </header>
    <main>
        <div class="container">
            <h1 class="title-container">Gerenciamento de Notícias</h1>
            <div class="row">
                <input type="text" name="search" placeholder="Pesquisar por titulo" class="control">
                <button type="submit" class="btn-pesquisa">Pesquisar</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($noticias as $noticia): ?>
                        <tr>
                            <td><?php echo $noticia['titulo']; ?></td>
                            <td><?php echo $noticia['autor']; ?></td>
                            <td>
                                <div class="row">
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" name="delete" class="btn-excluir">Excluir ✖︎</button>
                                    </form>
                                    <a href="editarUsuario.php?id=<?php echo $user['id']; ?>" class="btn-editar">Editar
                                        ✎</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>