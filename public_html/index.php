<?php
// Database configuration
require_once "server/connection.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
      <div class="container">
        <img class="logo" src="assets/imgs/logo.jpg"/>
        <h2 class="brand">0range</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shop.php">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
            
            <li class="nav-item">
              <a href="cart.php"><i class ="fas fa-shopping-cart"></i></a>
              <a href="account.php"><i class="fas fa-user"></i></a>
            </li>
        </ul>
        </div>
      </div>
    </nav>


     <!-- Home -->
    <section id="home">
        <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Best Prices</span> This Season</h1>
        <p>Eshop offers the best products for the most affordable prices</p>
        <button>Shop Now</button>
        </div>
    </section>


    <!-- Brand -->
    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.png">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.png">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png">
        </div>
    </section>

<!--New-->
<section id="new" class="w-100">
    <div class="row p-0 m-0">
        <!--one-->
        <div class=" one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/1.jpg" alt="Extremely Awesome Shoes">
            <div class="details">
                <h2>Extremely Awesome Shoes</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>
        <!--two-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/2.jpeg" alt="Another Awesome Product">
            <div class="details">
                <h2>Another Awesome Product</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>
        <!--three-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/3.jpg" alt="Yet Another Amazing Product">
            <div class="details">
                <h2>Yet Another Amazing Product</h2>
                <button class="text-uppercase">Shop Now</button>
            </div>
        </div>
    </div>
</section>

<!--featured-->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Our Featured</h3>
        <hr>
        <p>Here you can check out our new featured products</p>
</div>
<div class="row mx-auto container-fluid">

<?php include('server/get_featured_products.php'); ?>

<?php while($row= $featured_products->fetch_assoc()) { ?>
    
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name"><?php echo $row['product_name'];?> </h5>
        <h4 class="p-price"> <?php echo $row['product_price'];?> </h4>
        <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
</div>

<?php } ?>

</div>
</section>

<!--banner-->
<section id="banner" class="my-5 py-5">
    <div class="container">
        <h4>MID SEASON SALE</h4>
        <h1> Autumn Collection <br> UP to 30% OFF</h1>
        <button class= "text-uppercase">shop Now</button>
        </div>
        </section>

        <!--clothes-->
        <section id="featured" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Dresses & Clothes</h3>
        <hr>
        <p>Here you can check out our amazing clothes</p>
</div>
<div class="row mx-auto container-fluid">

<?php include('server/get_coats.php'); ?>

<?php while($row= $coats_products->fetch_assoc()) { ?>
    
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name"><?php echo $row['product_name'];?> </h5>
        <h4 class="p-price"> <?php echo $row['product_price'];?> </h4>
        <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
</div>

<?php } ?>

</div>
</section>

<!--watches-->
<section id="watches" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Best Watches</h3>
        <hr>
        <p>Here you can check out our amazing shoes</p>
</div>
<div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes1.jpeg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes2.jpg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes3.jpg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/clothes4.jpg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
</div>
</section>

<!--shoes-->
<section id="featured" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Shoes</h3>
        <hr>
        <p>Here you can check out our amazing shoes</p>
</div>
<div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes1.jpeg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes2.jpeg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/shoes3.jpg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
<div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/clothes4.jpg"/>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
</div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
</div>
</div>
</section>

<!--footer-->
<footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="logo" src="assets/imgs/logo.jpg"/>
            <p class="pt-3">We provide the best products for the most affordable prices</p>
        </div>
        <div class="footer-two col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Featured</h5>
            <ul class="text-uppercase">
                <li><a href="#">Men</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="#">Boys</a></li>
                <li><a href="#">Girls</a></li>
                <li><a href="#">New Arrivals</a></li>
                <li><a href="#">Clothes</a></li>
            </ul>
        </div>
        <div class="footer-three col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
                <h6 class="text-uppercase">Address</h6>
                <p>1234 Street Name, City, England</p>
            </div>  
            <div>
                <h6 class="text-uppercase">Phone</h6>
                <p>+351 234 567 89</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email</h6>
                <p>info@email.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
                <img src="assets/imgs/footer1.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/footer1.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/footer1.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/footer1.jpg" class="img-fluid w-25 h-100 m-2"/>
            </div>
        </div>
    </div>
    <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="assets/imgs/payment.png"/>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap mb-2">
                <p>© 2023 Eshop. All Rights Reserved.</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>


        




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>