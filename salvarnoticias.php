<?php
 
    require_once("./config/config.php");
    require_once("./classes/Noticia.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $texto = $_POST['conteudo'];
        $data_publicacao = $_POST['data_publicacao'];
        $imagem = $_FILES['imagem'];
        //Validação do upload da imagem
        $nomeImagem = '';
        if ($imagem['error'] === UPLOAD_ERR_OK) {
            $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
            $tamanho = 10 * 1024 * 1024; //10mb
            //validar tipo de arquivo
            $tiposPermitidos = ['jpg', 'jpeg', 'png'];
            if (!in_array($extensao, $tiposPermitidos)) {
            die('Apenas arquivos jpg ou png são permitidos');
            }
            if($imagem['size'] > $tamanho) {
            die('O tamanho do arquivo não pode exceder 10mb');
            }
            //Gerar nome único para o arquivo
            $nomeImagem = uniqid().'.'.$extensao;
            $destino = 'uploads/'.$nomeImagem;
            //Mover o arquivo para o destino
            if(!move_uploaded_file($imagem['tmp_name'], $destino)) {
            die('Erro ao salvar a imagem');
            } else if($imagem['error'] != UPLOAD_ERR_NO_FILE){
           // die('Erro ao fazer upload da image');
            }
            $noticia = new Noticia($db);
           
            $noticia->salvarNoticia($titulo, $autor, $data_publicacao, $texto, $nomeImagem);
            echo'Notícia salva com sucesso';
            echo"<br><a href='index.php'>Voltar</a>";
        }
    }

?>