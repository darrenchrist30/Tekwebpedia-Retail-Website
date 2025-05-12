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
   <title>search page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/web.css">

   <!-- jQuery CDN link -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

<?php include 'header.php'; ?>

<section class="search-form">

   <form id="searchForm" method="POST">
      <input type="text" class="box" name="search" placeholder="pencarian...">
      <button type="submit" class="btn" name="search_btn"><i class="fas fa-search" id="searchBtn"></i></button>
   </form>

</section>

<section class="products" style="padding-top: 0; min-height: 70   px;">

   <div class="box-container">

   <?php
      if(isset($_POST['search_btn'])){
      $search_box = $_POST['search'];
      $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%'");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">Rp. <span><?= number_format($fetch_products['total_price'], 0, ',', '.'); ?></span></div>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
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
   }else{
      echo '<p class="empty">no result found!</p>';
   }
      
   };
   ?>

   </div>

</section>

<script>

   $(document).ready(function () {

   var searchInput = $('input[name="search"]');

   searchInput.on('input', function () {

      var searchValue = searchInput.val();

         if (searchValue.trim() !== '') {
            $.ajax({
               type: 'POST',
               url: 'search_ajax.php',
               data: { search: searchValue },
               dataType: 'json',
               success: function (response) {

                  $('.box-container').empty();

                     if (response.length > 0) {
                        $.each(response, function (index, product) {
                              var productHTML =
                                 '<form action="" class="box" method="POST">' +
                                 '<div class="price">$<span>' + product.price + '</span>/-</div>' +
                                 '<img src="uploaded_img/' + product.image + '" alt="">' +
                                 '<div class="name">' + product.name + '</div>' +
                                 '<input type="hidden" name="pid" value="' + product.id + '">' +
                                 '<input type="hidden" name="p_name" value="' + product.name + '">' +
                                 '<input type="hidden" name="p_price" value="' + product.price + '">' +
                                 '<input type="hidden" name="p_image" value="' + product.image + '">' +
                                 '<input type="number" min="1" value="1" name="p_qty" class="qty">' +
                                 '<input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">' +
                                 '<input type="submit" value="add to cart" class="btn" name="add_to_cart">' +
                                 '</form>';

                              $('.box-container').append(productHTML);
                        });
                     } else {
                        $('.box-container').append('<p class="empty">No results found!</p>');
                     }
                  },
                  error: function () {
                     console.error('Ajax request failed');
                  }
            });
         } else {

            $('.box-container').empty();
         }
      });
});


</script>  

<?php include 'footer.php'; ?>



<script src="js/script.js"></script>

</body>
</html>