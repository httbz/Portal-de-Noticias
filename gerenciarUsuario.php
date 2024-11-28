<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

$usuario = new Usuario($db);
$usuarios = $usuario->listarTodos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $usuario->deletar($_POST['id']);
        header("Location: gerenciarUsuario.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="style_gUsuario.css">
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Administração</h1>
        <a href="portal.php" class="btn-voltar">Voltar</a>
    </header>
    <main>
        <div class="container">
            <h1 class="title-container">Gerenciamento de Usuários</h1>
            <form method="GET">
                <div class="row">
                    <input type="text" name="search" placeholder="Pesquisar por nome ou e-mail" class="control">
                    <button type="submit" class="btn-pesquisa">Pesquisar</button>
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td><?php echo $user['nome']; ?></td>
                            <td><?php echo $user['email']; ?></td>
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