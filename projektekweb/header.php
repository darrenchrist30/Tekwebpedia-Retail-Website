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

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin header</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <style>

   @keyframes fadeIn {
   0%{
      transform: translateY(1rem);
   }
}
   .header .flex .profile{
      position: absolute;
      top:120%; right:2rem;
      border: 1px solid black;
      border-radius: .5rem;
      padding:2rem;
      text-align: center;
      background-color: #fff;
      width: 33rem;
      display: none;
      animation: fadeIn .2s linear;
}

   .header .flex .profile.active{
      display: inline-block;
}

   .header .flex .profile img{
      height: 15rem;
      width: 15rem;
      margin-bottom: 1rem;
      border-radius: 50%;
      object-fit: cover;
}

   .header .flex .profile p{
      padding:.5rem 0;
      font-size: 2rem;
      color: grey;
}

   .header .flex .logo {
      font-weight: 500;
      color: black;
}
</style>
</head>
<body>

<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">TEKWEBPEDIA<span>.</span></a>
      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="shop.php">Shop</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">Tentang kami</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>

      <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>
      
      
      
   </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var userBtn = document.getElementById("user-btn");
        var profileDiv = document.querySelector(".header .flex .profile");

        userBtn.addEventListener("click", function () {
            // Toggle tampilan profil
            if (profileDiv.style.display === "none" || profileDiv.style.display === "") {
                profileDiv.style.display = "block";
            } else {
                profileDiv.style.display = "none";
            }
        });

        // Tambahan: Sembunyikan profil saat klik di luar elemen profil
        document.addEventListener("click", function (event) {
            if (!event.target.matches("#user-btn") && !event.target.closest(".header .flex .profile")) {
                profileDiv.style.display = "none";
            }
        });
    });
</script>
   
</body>
</html>



