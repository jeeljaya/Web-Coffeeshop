<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';
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
    <link rel="stylesheet" href="css/style2.css">
    

</head>
<body>
    <!-- header section starts  -->
    
<!-- header section ends -->
<!-- heading -->
<div class="heading">
   <h3>Menu</h3>
   <p><a href="index.php">Home</a><a href="cart.php"> / Cart</a><a href="search.php"> / Search</a></p>
</div>

<!-- menu section starts  -->

<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_menu = $conn->prepare("SELECT * FROM `menu`");
         $select_menu->execute();
         if($select_menu->rowCount() > 0){
            while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_menu['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_menu['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_menu['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_menu['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_menu['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_menu['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_menu['category']; ?>" class="cat"><?= $fetch_menu['category']; ?></a>
         <div class="name"><?= $fetch_menu['name']; ?></div>
         <div class="flex">
            <div class="price"><span>Rp</span><?= $fetch_menu['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no menu added yet!</p>';
         }
      ?>

   </div>

</section>

      <!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>