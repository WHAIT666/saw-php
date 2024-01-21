<?php
session_start();
include('C:/xampp/htdocs/saw/public_html/server/connection.php');

// Initialize error variables
$emailError = $passwordError = $loginError = '';

// Redirect the user to the account page if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: /admin/dashboard/index.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    
  $email = $_POST['email'];
    $password = md5 ($_POST['password']);

    // Fetch user details from the database based on email
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? and admin_password = ? LIMIT 1");
    
    $stmt->bind_param('ss', $email, $password);
    
    $stmt->execute();
    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
        $stmt->fetch();


            // Set session variables and redirect to login.php
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('Location: /admin/dashboard/index.php?login_success=Logged in successfully');
            exit;
        } else {
            // Password does not match
            $passwordError = 'Incorrect password';
        }
    } else {
        // User not found
        $emailError = 'Email not registered';
    }

    // Display login error
    $loginError = 'Invalid credentials. Please try again.';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form method="post" action="">
        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>

        <!-- Display error messages -->
        <?php if (!empty($loginError)): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $loginError; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($emailError)): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $emailError; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($passwordError)): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $passwordError; ?>
          </div>
        <?php endif; ?>

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login_btn">Sign in</button>
      </form>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>