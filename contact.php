<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>
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

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <div class="row">

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.7723784547916!2d119.51818021476419!3d-5.140310296269666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee51ec060822d%3A0x5ffccf80fd68c44e!2sATRIUM%20COFFEE!5e0!3m2!1sid!2sid!4v1667808764595!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <form action="" method="post">
            <h3>send us message</h3>
            <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
            <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
            <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="enter your number" class="box">
            <textarea name="msg" class="box" required maxlength="1000" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
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