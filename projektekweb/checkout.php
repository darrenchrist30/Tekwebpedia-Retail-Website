<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['checkout'])) {
   
      $name = $_POST['name'];
      $number = $_POST['number'];
      $email = $_POST['email'];
      $method = $_POST['payment'];
      $address = 'Alamat : ' .$_POST['province'] .', '. $_POST['city'] .', '. $_POST['address'] .' '. $_POST['postal_code'];
      $placed_on = date('Y-m-d');
   
      $cart_total = 0;
      $cart_products[] = '';
      $select_cart_barang = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_barang->execute([$user_id]);
      if($select_cart_barang->rowCount() > 0){
         while($fetch_cart_barang = $select_cart_barang->fetch(PDO::FETCH_ASSOC)){
   
            $cart_total = $cart_total + ($fetch_cart_barang['price'] * $fetch_cart_barang['quantity']);
   
            $cart_products[] = $fetch_cart_barang['name'] .' x ' .$fetch_cart_barang['quantity'];
            $total = $fetch_cart_barang['price'] * $fetch_cart_barang['quantity'];
            $cart_total += $total;
         };
      };

      $total_products = implode(', ', $cart_products);

         $order = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
         $order->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);
         
         if($cart_total == 0){
            $message[] = 'keranjang anda kosong';
         } else if($order->rowCount() > 0) {
            $message[] = 'pesanan anda sudah ada';
         } else {
            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES (?,?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
            $message[] = 'pesanan anda berhasil';
         }
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <style>

      .checkout{
         width: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
         margin-top: 50px;
      }

      .checkout img{
         margin-bottom: 20px;
      }

      .checkout p{
         font-size: 20px;
         font-weight: 500;
         margin-bottom: 10px;
      }

      .checkout p span{
         font-size: 18px;
         font-weight: 400;
         color: #555;
      }

      .checkout .total{
         font-size: 22px;
         font-weight: 500;
         margin-top: 20px;
      }

      .checkout .total span{
         font-size: 20px;
         font-weight: 400;
         color: #555;
      }

      .checkout-item{
         width: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
         margin-top: 50px;
      }

      .checkout-item h1{
         font-size: 4rem;
         font-weight: 500;
         margin-bottom: 20px;
      }

      .checkout-item h3{
         font-size: 1.5rem;
         font-weight: 500;
         margin-bottom: 10px;
      }

      .checkout-item .flex{
         width: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-wrap: wrap;
      }

      .checkout-item .inputBox{
         width: 100%;
         margin-bottom: 20px;
      }

      .checkout-item .inputBox input{
         width: 100%;
         padding: 10px;
         font-size: 2rem;
         font-weight: 500;
         border: none;
         outline: none;
         border-bottom: 1px solid #555;
         margin-top: 5px;
      }

      .checkout-item .inputBox input:focus{
         border-bottom: 2px solid #555;
      }

      .checkout-item .inputBox select{
         width: 100%;
         padding: 10px;
         font-size: 18px;
         font-weight: 500;
         border: none;
         outline: none;
         border-bottom: 1px solid #555;
         margin-top: 5px;
      }

      .checkout-item .inputBox select:focus{
         border-bottom: 2px solid #555;
      }

      .checkout-item .inputBox .btn{
         width: 100%;
         padding: 14px;
         font-size: 18px;
         font-weight: 500;
         border: none;
         outline: none;
         border-radius: 5px;
         background: brown;
         color: #fff;
         cursor: pointer;
         margin-top: 30px;
      }

      .checkout-item .inputBox .btn:hover{
         background: #666;
      }

      .checkout-item .inputBox .btn:focus{
         background: #666;
      }

   </style>

</head>
<body>
   
<?php include 'header.php'; ?>
<section class="checkout">

   <?php
   $cart_total = 0;
   $select_cart_barang = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $select_cart_barang->execute([$user_id]);
   if($select_cart_barang->rowCount() > 0){
      while($fetch_cart_barang = $select_cart_barang->fetch(PDO::FETCH_ASSOC)){
         $cart_total = $cart_total + ($fetch_cart_barang['price'] * $fetch_cart_barang['quantity']);
   ?>
   <img src="uploaded_img/<?= $fetch_cart_barang['image']; ?>" alt="" width="150">
   <p><?= $fetch_cart_barang['name']; ?><span>(<?= 'Rp. ' .$fetch_cart_barang['price'] .' x '. $fetch_cart_barang['quantity']; ?>)</span></p>
   <p>Total item : <span>(<?= 'Rp. ' .$fetch_cart_barang['price'] * $fetch_cart_barang['quantity']; ?>)</span></p>
   <?php
      }     
   } else {
      '<p class="empty">keranjang anda kosong</p>';
   }
   ?>
   <div class="total">Total Belanja : <span>Rp. <?= $cart_total; ?></span></div>

</section>

<section class="checkout-item">

   <form action="" method="POST">

      <h1>Pesanan anda</h1>

      <div class="flex">
         <div class="inputBox">
            <h3>nama : </h3>
            <input type="text" name="name" id="" placeholder="masukkan nama anda" class="box " required>
         </div>
         <div class="inputBox">
            <h3>email : </h3>
            <input type="email" name="email" id="" placeholder="masukkan email anda" class="box " required>
         </div>
         <div class="inputBox">
            <h3>number : </h3>
            <input type="number" name="number" id="" placeholder="masukkan nomor anda" class="box " required>
         </div>
         <div class="inputBox">
            <h3>provinsi :</h3> 
            <input type="text" name="province" id="" class="box" placeholder="masukkan provinsi anda" required>
         </div>
         <div class="inputBox">
            <h3>kota : </h3>
            <input type="text" name="city" id="" class="box" placeholder="masukkan kota anda" required>
         </div>
         <div class="inputBox">
            <h3>alamat :</h3>
            <input type="text" name="address" id="" class="box" placeholder="masukkan alamat anda" required>
         </div>
         <div class="inputBox">
            <h3>kode pos :</h3> 
            <input type="number" name="postal_code" id="" class="box" placeholder="masukkan kode pos anda" required>
         </div>    
         <div class="inputBox">
            <h3>payment : </h3>
            <select name="payment" id="" class="box " required>
            <option value="BCA">BCA</option>
            <option value="BNI">BNI</option>
            <option value="BRI">BRI</option>
            <option value="Mandiri">Mandiri</option>
         </div>
         <div class="inputBox">
            <input type="submit" value="checkout" name="checkout" class="btn">
         </div>
      </div>
         

   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>