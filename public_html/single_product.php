<?php 

include('server/connection.php');

if(isset($_GET['product_id'])) {


  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i", $product_id);

  $stmt->execute();

  $product = $stmt->get_result(); //[]

}else{

  header('location: index.php');
  exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .product img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }

        .pagination a{
            color: black;
        }

        .pagination li:hover a{
            color: #fff;
            background-color: yellow;
        }
        </style>
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
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <i class="fas fa-shopping-cart"></i>
        </li>
        <li class="nav-item">
          <i class="fas fa-user"></i>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!--single product-->
<section class="container single-product my-5 pt-5">
  <div class="row mt-5">

    <?php while($row = $product->fetch_assoc()){ ?>
    
      <div class="col-lg-6 col-md-6 col-sm-12">
      <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg"/>
      <div class="small-img-group">
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
        </div>
      </div>
    </div>



    <div class="col-lg-6 col-md-6 col-sm-12">
      <h6>Men/Shoes</h6>
      <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
      <h2>€<?php echo $row['product_price']; ?></h2>
      <input type="number" value="1"/>
      <button class="buy-btn">Add To Cart</button>
      <h4 class="mt-5 mb-5">Product Details</h4>
      <span><?php echo $row['product_description']; ?>
      </span>
    </div>

    <?php } ?>
  
  
  </div>
</section>


<!--Related products-->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Related Porducts</h3>
        <hr>
        <p>Here you can check out our new featured products</p>
</div>
<div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/featured1.jpg"/>
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
        <img class="img-fluid mb-3" src="assets/imgs/featured2.jpg"/>
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
        <img class="img-fluid mb-3" src="assets/imgs/featured3.jpg"/>
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
        <img class="img-fluid mb-3" src="assets/imgs/featured4.jpg"/>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for (let i = 0; i < 4; i++) {
            smallImg[i].addEventListener("click", function () {
                mainImg.src = smallImg[i].src;
            });
        }
    });
</script>
</body>
</html>