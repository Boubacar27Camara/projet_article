<?php
$servername = "localhost";
$username = "root";
$password = "";

try {


  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
  $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;


  $pdo_options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_OBJ;
  $conn = new PDO("mysql:host=$servername;dbname=mglsi_news", $username, $password,$pdo_options);
    // set the PDO error mode to exception
  //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $resultCath = $conn->prepare("SELECT * FROM categorie ");

  $resultCath->execute();
  $resultCath = $resultCath->fetchAll(); 


  $article_id = $_GET["article_id"];

  $result = $conn->prepare("SELECT * FROM article WHERE article.categorie=:x");
  $result->bindParam('x', $article_id);

  $result->execute();
  $result = $result->fetchAll(); 
  //var_dump($result);






  //$result = $result->fetchAll(); 

//var_dump($result[0]->titre);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


function  return_text($text){
  if(  strlen($text)>90 ) return substr($text, 0,90);
  return $text;
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Klean - Cleaning Services Website Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link type="text/css"
  href="style/accueil.css"
  rel="stylesheet">
  <title></title>
</head>
<body>

  <h1>Actualité au senegal</h1>

  <ul class="menu">
    <li><a href="#" class="active">Accueil</a></li>
    <?php for($i=1; $i <=sizeof($resultCath); $i++) {   
      
     echo "<li><a href=\"showOneCat.php?article_id=".$resultCath[$i-1]->id."\">".  $resultCath[$i-1]->libelle ."</a></li>";
     


     
     
   } ?>
   <li class="slider"></li>
 </ul>






 <!-- Blog Start -->

 
 
 <div class="container-fluid pt-5">
  <div class="container pt-5">


    <div class="row">
      <?php for($i=1; $i <=sizeof($result); $i++) { 

        if($i%4==0){ echo "</div></div></div><div class='container pt-5'><div class='container pt-5'><div class='row'> "; }?> 



        <div class="col-lg-4 col-md-6 mb-5">
          <div class="position-relative mb-4">
            <img class="img-fluid rounded w-100" src="img/blog.jpg" alt="">
            <div class="blog-date">
              <h4 class="font-weight-bold mb-n1">01</h4>
              <small class="text-white text-uppercase">Mane</small>
            </div>
          </div>

          <h5 class="font-weight-medium "><?php echo $result[$i-1]->titre; ?></h5>
          <p class="container"><?php echo  return_text( $result[$i-1]->contenu) ?>....<a style="color: black;" href="#">lire plus</a></p>

        </div>




      <?php }?>


    </div></div></div>





    <!-- Blog End -->

  </body>
  </html>