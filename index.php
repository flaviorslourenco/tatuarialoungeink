<!doctype html>
<html>

<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <title>Tattooaria Lounge Ink - Inicio</title>
  <link href="img/logo.jpg" rel="icon">
  <link href="css/styles.css" rel="stylesheet">
  
  <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  
  <?php include 'header.php'?>

  <ul class="whatsapp">
    <li><p>Fale conosco!</p></li>
    <li><a href="https://api.whatsapp.com/send?phone=5565999781134&text=Olá"><img src="img/rede-social/whatsapp.png"></a></li>
  </ul>

  <div class="main">

    <div class="slideshow"> <!-- carrosel -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">

            <li data-target="#carouselExampleIndicators" data-slide-to="slide01"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="slide02"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="slide03"></li>
          
        </ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item">
            <img src="img/postfoto01.png" class="d-block w-100" alt="slide01">
          </div>

          <div class="carousel-item">
            <img src="img/fernando01.png" class="d-block w-100" alt="slide02">
          </div>

          <div class="carousel-item">
            <img src="img/local.PNG" class="d-block w-100" alt="slide03">
          </div>

        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Proxima</span>
        </a>
      </div>
    </div> <!-- fim carrosel -->
    
      <div class="section">
        <div class="full-section">
          <h3>BEM-VINDO Á TATTOOARIA LOUNGE INK</h3>
        </div>
      </div>

    <?php include 'conexao/conecta.php';
     
      $feed_query = "SELECT * FROM feed ORDER BY id ASC";
      $resultado = mysqli_query($conn, $feed_query);
      $count_feed = 1;

      while($row = mysqli_fetch_assoc($resultado)){ 
        if($count_feed % 2){?>
      
      <section class="post-section">
        
        <div class="post-imagem">
          <img src="uploads/feed/<?php echo $row['imagem'];?>">
        </div>
      
        <div class="post-text">
          <ul>
            <li> <h3><?php echo $row['titulo'];?></h3> </li>
            <li> <p><?php echo $row['texto'];?></p> </li>
          </ul>
        </div>
            
      </section>

      <?php }else{ ?>

      <section class="post-section">
        
        <div class="post-text">
          <ul>
            <li> <h3><?php echo $row['titulo'];?></h3> </li>
            <li> <p><?php echo $row['texto'];?></p> </li>
          </ul>
        </div>
      
        <div class="post-imagem">
          <img src="uploads/feed/<?php echo $row['imagem'];?>">
        </div>
          
      </section>
  
    <?php }/* $count_feed ++; */} ?>

    <div class="section">
      <div class="full-section">
        <h3>NOSSOS ARTISTAS</h3>
      </div>
    </div>

    <section class="post-section">
        
      <div class="post-imagem">
        <img src="img/noimage.png">
      </div>
    
      <div class="post-text">
        <ul>
          <li> <h3>Nome Sobrenome</h3> </li>
          <li> <p>BIOGRAFIA</p> </li>
          <li> <a href="https://www.facebook.com/tattooarialoungeink/" target="_blank"><img src="img/rede-social/facebook2.png">Facebook</a></li>
          <li> <a href="https://www.instagram.com/tattooarialoungeink/" target="_blank"><img src="img/rede-social/instagram2.png">Instagram</a></li>
        </ul>
      </div>
          
    </section>

    <section class="post-section">
        
      <div class="post-imagem">
        <img src="img/noimage.png">
      </div>
    
      <div class="post-text">
        <ul>
          <li> <h3>Nome Sobrenome</h3> </li>
          <li> <p>BIOGRAFIA</p> </li>
          <li> <a href="https://www.facebook.com/tattooarialoungeink/" target="_blank"><img src="img/rede-social/facebook2.png">Facebook</a></li>
          <li> <a href="https://www.instagram.com/tattooarialoungeink/" target="_blank"><img src="img/rede-social/instagram2.png">Instagram</a></li>
        </ul>
      </div>
          
    </section>

    <div class="section">
      <div class="full-section">
        <h3>PATROCINADORES</h3>
      </div>
    </div>
    
    <section class="post-section">
      <div class="patrocinadores">
        <?php 
          $query_sponsors = "SELECT * FROM sponsors ORDER BY id ASC";
          $result_sponsors = mysqli_query($conn, $query_sponsors);
            
          while($row_sponsors = mysqli_fetch_assoc($result_sponsors)){?>
          <a href="<?php echo $row_sponsors['link']?>"><img src="uploads/sponsors/<?php echo $row_sponsors['imagem']?>"></a>
        <?php }?>
      </div>
    </section>

  </div>
  <?php include 'footer.php'?>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
