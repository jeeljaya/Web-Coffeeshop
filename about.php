<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>coffee shop atrium coffee</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   
</head>
<body>
   
<!-- header section starts  -->

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="#" class="logo">
            <img src="images/logo.png" alt="">
      </a>

      <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
            <a href="menu.php">menu</a>
            <a href="orders.php">orders</a>
            <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
            
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
   
         <p class="name">shaikh anas</p>
            <div class="flex">
               <a href="profile.php" class="btn">profile</a>
               <a href="#" class="delete-btn">logout</a>
            </div>
         <p class="account"><a href="login.php">login</a> or <a href="register.php">register</a></p>
      </div>
   
   </section>
</header>

<section class="about" id="about">

   <h1 class="heading"> <span>about</span> us </h1>

   <div class="row">

      <div class="image">
            <img src="images/about-img.jpeg" alt="">
      </div>

      <div class="content">
            <h3>apa yang membuat atrium coffee ini special?</h3>
            <p>atrium coffee  berdiri sejak tahun 2017 dan bertahan sampai sekarang. Caffe kami menawarkan berbagai macam menu yang enak terutama kopi yang kami sediakan sangat enak dan sangat cocok untuk nongki2 happy  </p>
            <p></p>
            <!-- <a href="#" class="btn">learn more</a> -->
      </div>

   </div>

</section>
<section class="footer">

   <div class="share">
      <a href="https://web.facebook.com/atrium.coffee.9/?_rdc=1&_rdr" class="fab fa-facebook-f"></a>
      <a href="https://twitter.com/atriumciren" class="fab fa-twitter"></a>
      <a href="https://www.instagram.com/atrium.coffee_/?hl=id" class="fab fa-instagram"></a>
   </div>
</section>
   <!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>