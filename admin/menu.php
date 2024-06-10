<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_menu'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_menu = $conn->prepare("SELECT * FROM `menu` WHERE name = ?");
   $select_menu->execute([$name]);

   if($select_menu->rowCount() > 0){
      $message[] = 'menu name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_menu = $conn->prepare("INSERT INTO `menu`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_menu->execute([$name, $category, $price, $image]);

         $message[] = 'new menu added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_menu_image = $conn->prepare("SELECT * FROM `menu` WHERE id = ?");
   $delete_menu_image->execute([$delete_id]);
   $fetch_delete_image = $delete_menu_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_menu = $conn->prepare("DELETE FROM `menu` WHERE id = ?");
   $delete_menu->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:menu.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add menu</h3>
      <input type="text" required placeholder="enter menu name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="enter menu price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add menu" name="add_menu" class="btn">
   </form>

</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_menu = $conn->prepare("SELECT * FROM `menu`");
      $show_menu->execute();
      if($show_menu->rowCount() > 0){
         while($fetch_menu = $show_menu->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_menu['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>Rp</span><?= $fetch_menu['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_menu['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_menu['name']; ?></div>
      <div class="flex-btn">
         <a href="update_menu.php?update=<?= $fetch_menu['id']; ?>" class="option-btn">update</a>
         <a href="menu.php?delete=<?= $fetch_menu['id']; ?>" class="delete-btn" onclick="return confirm('delete this menu?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no menu added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>