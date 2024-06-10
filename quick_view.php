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
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style3.css">

</head>
<body>
   
<div class="heading">
   <h3>View</h3>
   <p><a href="menu.php">Menu</a><a href="checkout.php"> / Checkout</a></p>
</div>

<section class="quick-view">

   <h1 class="title">quick view</h1>

   <?php
      $pid = $_GET['pid'];
      $select_menu = $conn->prepare("SELECT * FROM `menu` WHERE id = ?");
      $select_menu->execute([$pid]);
      if($select_menu->rowCount() > 0){
         while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_menu['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_menu['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_menu['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_menu['image']; ?>">
      <img src="uploaded_img/<?= $fetch_menu['image']; ?>" alt="">
      <a href="category.php?category=<?= $fetch_menu['category']; ?>" class="cat"><?= $fetch_menu['category']; ?></a>
      <div class="name"><?= $fetch_menu['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Rp</span><?= $fetch_menu['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
      <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>



















<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>