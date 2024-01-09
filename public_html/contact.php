<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'SAW');

// Connect to the database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Close the database connection
mysqli_close($conn);
?>

<?php include('layouts/header.php'); ?>

    <!--Contact-->
    <section id="contact" class="container my-5 py-5">
    <div class="container text-center mt-5">
        <h3>Contact Us</h3>
        <hr class="mx-auto">
        <p class="w-50 mx-auto">
            Phone Number: <span>+351 234 567 89</span>
</p>
<p class="w-50 mx-auto">
            Email Address: <span>info@email.com</span>
</p>
<p class="w-50 mx-auto">
    We work 24-7 to answer your questions
</p>
</div>
</section>


<?php include('layouts/footer.php'); ?>
        
