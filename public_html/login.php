<?php
session_start();
include('server/connection.php');

// Redirect the user to the account page if already logged in
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user details from the database based on email
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_name, $user_email, $hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Check if the user exists
    if($user_id){
        // Check if the provided password is correct
        if(password_verify($password, $hashedPassword)){
            // Set session variables and redirect to account page
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=Logged in successfully');
        } else {
            // Password does not match
            header('location: login.php?error=Incorrect password');
        }
    } else {
        // User not found
        header('location: login.php?error=Email not registered');
    }
}
?>

<?php include('layouts/header.php'); ?>


    <!--Login-->
    <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="login-form" method="POST" action="login.php">
            <p style="color: red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login" value="Login"/>
            </div>
            <div class="form-group">
                <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</section>


<?php include('layouts/footer.php'); ?>