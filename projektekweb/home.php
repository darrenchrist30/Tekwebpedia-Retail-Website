<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/web.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <h1>Selamat datang di Toko <span>Tekwebpedia.</span></h1>
         <span>ingin cari part mobil?, solusinya</span>
         <h3>TEKWEBPEDIA</h3>
         <p>tersedia lampu mobil, turbo, shock breaker, dan banyak lagi. Silahkan klik untuk lebih lanjut.</p>
         <a href="about.php" class="btn">Tentang kami</a>
      </div>
      <div class="image">
         <img src="img/tokomobil.png" alt="Toko Image">      
      </div>
      

   </section>

</div>

<section class="home-category">

   <h1 class="title">Pilihan kategori etalase kami</h1>

   <div class="box-container">

      <div class="box">
         <img src="img/lampu2.jpeg" alt="">
         <h3>lampu</h3>
         <p>Lampu dengan kualitas no 1 yang dapat menerangi perjalanan anda sehingga lebih aman untuk berkendara.</p>
         <a href="category.php?category=lampu" class="btn">lampu</a>
      </div>

      <div class="box">
         <img src="uploaded_img/shock.jpg" alt="">
         <h3>shock</h3>
         <p>Shock dengan kualitas ternyaman yang dapat menemani anda saat perjalanan jauh.</p>
         <a href="category.php?category=shock" class="btn">shock</a>
      </div>

      <div class="box">
         <img src="uploaded_img/turbo1.jpeg" alt="">
         <h3>turbo</h3>
         <p>Turbo yang dapat meningkatkan tenaga mobil anda secara dratis.</p>
         <a href="category.php?category=turbo" class="btn">turbo</a>
      </div>

      <div class="box">
         <img src="uploaded_img/velg.jpg" alt="">
         <h3>velg</h3>
         <p>Membuat tampilan mobil anda tentunya lebih bagus dan lebih mewah.</p>
         <a href="category.php?category=velg" class="btn">velg</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Produk terbaru dari kami</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
      <form action="" class="box" method="POST">
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="price">Rp. <span><?= number_format($fetch_products['price'], 0, ',', '.'); ?></span></div>
         <div class="details"><span><?= $fetch_products['details']; ?></span></div>

         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
         <input type="number" min="1" value="1" name="p_qty" class="qty"> 
         <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
         <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         
      </form>
   <?php
      }
   }else {
         echo '<p class="empty">no products found!</p>';
   }
   ?>
      <form action="" class="box" method="POST">

      </form>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>