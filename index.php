<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
if($select_user->rowCount() > 0){
    $_SESSION['user_id'] = $row['id'];
    header('location:index.php');
}else{
    $message[] = 'incorrect username or password!';
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

<?php include 'components/user_header.php'; ?>

<section class="home" id="home">
    <div class="content">
        <h3>fresh coffee in the morning</h3>
        <p>Kalo minum kopi dirumah terkesan tidak gaul dan keren, kalo di atrium coffee beda ceritanya. Di sini kamu bisa minum kopi dengan gaul, sambil nongki2 happy..</p>
        <a href="menu.php" class="btn">get it now</a>
    </div>
</section>
<section class="about" id="abouphp
    <h1 class="heading> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.jpeg" alt="">
        </div>

        <div class="content">
            <h3>apa yang membuat atrium coffee ini special?</h3>
            <p>atrium coffee  berdiri sejak tahun 2017 dan bertahan sampai sekarang. Caffe kami menawarkan berbagai macam menu yang enak terutama kopi yang kami sediakan sangat enak dan sangat cocok untuk nongki2 happy  </p>
            <p></p>
            <a href="about.php" class="btn">learn more</a>
        </div>

    </div>

</section>



<?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>