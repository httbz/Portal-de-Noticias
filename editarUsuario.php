<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);

// Obter ID do usuário a ser editado
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID de usuário não fornecido.");
}

$dadosUsuario = $usuario->lerPorId($id);
if (!$dadosUsuario) {
    die("Usuário não encontrado.");
}

// Processar a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $usuario->atualizar($id, $nome, $sexo, $fone, $email);

    header('Location: gerenciarUsuario.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_cad.css">
    <title>Editar Usuário</title>
</head>

<body>
    <header>
        <img src="./assets/img/cnn-logo.png" alt="Logo" class="logo">
        <h1 class="title">Portal de Notícias</h1>
        <a href="gerenciarNoticia.php" class="btn-voltar">Voltar</a>
    </header>
    <main>
        <div class="container">
            <h1 class="title">Editar Usuário</h1>
            <form method="POST">
                <label>Nome:</label><br>
                <input class="control" type="text" name="nome" value="<?php echo htmlspecialchars($dadosUsuario['nome']); ?>"
                    required><br><br>

                <label>Sexo:</label><br>
                <input class="control" type="text" name="sexo" value="<?php echo htmlspecialchars($dadosUsuario['sexo']); ?>"
                    required><br><br>

                <label>Telefone:</label><br>
                <input class="control" type="text" name="fone" value="<?php echo htmlspecialchars($dadosUsuario['fone']); ?>"
                    required><br><br>

                <label>E-mail:</label><br>
                <input class="control" type="email" name="email" value="<?php echo htmlspecialchars($dadosUsuario['email']); ?>"
                    required><br><br>

                <input class="btn" type="submit" value="Salvar Alterações">
            </form>
        </div>
    </main>
</body>

</html>