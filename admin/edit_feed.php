<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Tattooaria Lounge Ink</title>
  <link href="../img/logo.jpg" rel="icon">
  
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <?php include 'header.php' ?>

  <!-- Begin page content -->
  <main role="main" class="flex-shrink-0">
    <div class="container">

        <form name="cadastrar" method="POST" enctype="multipart/form-data">
            <?php

                $id = $_GET["id"]; //pega o código passado via URL
                include '../conexao/conecta.php';
                $query = "SELECT * FROM feed WHERE id = $id LIMIT 1";
                $result = mysqli_query($conn, $query);
                if($result){ $row = mysqli_fetch_assoc($result);
                $imagem = $row['imagem'];
            ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nome">Titulo</label>
                <input type="text" class="form-control" name="titulo" required id="nome" value="<?php echo $row['titulo'];?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Texto</label>
                <textarea class="form-control" name="texto" required id="exampleFormControlTextarea1" rows="6" ><?php echo $row['texto'];?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Escolha a foto.</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto[]">
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="reset" name="limpar" id="limpar">Limpar</button>
                <button class="btn btn-primary" type="submit" name="cadastrar" id="cadastrar">Atualizar</button>
            </div>
            <?php
            
                }else{
                    echo '
                        <div class="alert alert-danger" role="alert">
                            <strong>Post não encontrado, tente novamente!</strong>
                        </div>';
                    exit();
                }
                mysqli_close($conn);
            ?>
        </form>

        <?php 
        
        if (isset($_POST['cadastrar'])){

        include '../conexao/conecta.php';

        $foto = $_FILES['foto'];
        $nome = $_POST['titulo'];
        $descricao = $_POST['texto'];
        $id = $_POST['id'];

        for ($k = 0; $k < count($foto['name']); $k++){

        if($foto["name"][$k] != false){

            unlink("../uploads/feed/$imagem");

        if(!empty($foto["name"][$k])){
            $largura = 4920;
            $altura = 4080;
            $tamanho = 100000000;
            $error = array();
            
            if(!preg_match("/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/", $foto["type"][$k])){
                $error[1] = "Isso não é uma imagem.";
            }
            
            $dimensoes = getimagesize($foto["tmp_name"][$k]);
            
            if($dimensoes[0] > $largura){
                $error[2]="A largura da imagem não deve ultrapassar".$largura." pixels";
            }
            if($dimensoes[1] > $altura){
                $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
            }
            if($foto["size"][$k]>$tamanho){
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
            }
            
            if(count($error) == 0){

                //pega a extensão da imagem
                preg_match('/\.(gif|bmp|png|jpg|jpeg){1}$/i', $foto['name'][$k], $ext);
                //gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                //caminho onde ficara a imagem
                $caminho_imagem = "../uploads/feed/" . $nome_imagem;
                
                //Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($foto["tmp_name"][$k], $caminho_imagem);
                $insere = "UPDATE feed SET titulo = '$nome', imagem = '$nome_imagem', texto = '$descricao' WHERE id = '$id'";
               
                $result = mysqli_query($conn, $insere);
                
            }
                //Se houver mensagens de erro, exibe-as
                if(count($error)!=0){
                    foreach($error as $erro){
                    echo '<p>'.$erro . '</p>';
                    }
                }
            }
            }else{
                $insere = "UPDATE feed SET titulo='$nome', texto='$descricao' WHERE id = '$id'";
                $result = mysqli_query($conn, $insere);

            }
            if($result){
                
                echo '<p>Post editado com sucesso!</p>';
            
            }else{
                echo '<p>Erro ao editar post! Por favor, tente novamente.</p>';
            }
        }
        mysqli_close($conn);
    }
    ?>

    </div>
  </main>

  <?php include 'footer.php'?>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>