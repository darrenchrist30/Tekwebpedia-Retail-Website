<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>footer</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/mystyle.css">

   <style>
      
      @media (max-width: 1200px) {
         .footer .box-container .box{
            width: calc(50% - 20px);
         }
      }
      @media (max-width: 768px) {
         .footer .box-container .box{
            width: 100%;
         }
      }
   </style>
</head>
<body>

   <footer class="footer">
   <section class="box-container">
      <div class="box">
         <h3>Link kami</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> shop</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
      </div>

      <div class="box">
         <h3>Link kami</h3>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
         <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> register</a>
      </div>

      <div class="box">
         <h3>Contact kami</h3>
         <p> <i class="fas fa-phone"> </i>+6287634253</p>
         <p> <i class="fas fa-phone"> </i>+6287634263</p>
         <p> <i class="fas fa-envelope"> </i>test123@gmail.com</p>
         <p> <i class="fas fa-map-marker-alt"> </i> Indonesia </p>
      </div>

      <div class="box">
         <h3>Follow kami</h3>
         <a href="#"> <i class="fab fa-facebook-f"> facebook: test123</i></a>
         <a href="#"> <i class="fab fa-twitter"> twitter: test123</i></a>
         <a href="#"> <i class="fab fa-instagram"> instagram: @test123</i></a>
         <a href="#"> <i class="fab fa-linkedin"> linkedin: test123</i></a>
      </div>
   </section>
</footer>
   
</body>
</html>

