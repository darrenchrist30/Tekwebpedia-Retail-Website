<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/web.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="img/tokomobil.png" alt="">
         <h3>kenapa milih kami?</h3>
         <p>Toko TekwebPedia yang sudah berdiri sejak tahun 2014 yang menyediakan barang mobil secara lengkap dan pastinya original 100%.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>
      <div class="box">
         <img src="uploaded_img/kar.png" alt="">
         <h3>barang produk kami</h3>
         <p>Kami menawarkan berbagai macam produk barang yang tentunya bergaransi, harga terjangkau, dan kualitas nomor 1 di Indonesia.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Reviews / ulasan</h1>

   <div class="box-container">

      <div class="box">
         <img src="uploaded_img/kar.png" alt="">
         <p>Toko terpercaya dan kualitas barang terbukti original dan bagus</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>
      <div class="box">
         <img src="uploaded_img/mickey.png" alt="">
         <p>Toko terpercaya dan kualitas barang terbukti original dan bagus</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>
      <div class="box">
         <img src="uploaded_img/patrick.png" alt="">
         <p>Toko terpercaya dan kualitas barang terbukti original dan bagus</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>
      <div class="box">
         <img src="uploaded_img/minions.png" alt="">
         <p>Toko terpercaya dan kualitas barang terbukti original dan bagus</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>