<?php
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
}


if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
    
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
    
}

}


if(isset($_POST['change_password'])){

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $user_email = $_SESSION['user_email'];

    //if password dont match
    if($password !== $confirmPassword){
    header('location: account.php?error=Passwords do not match');
  


  //if password is less than 6 characters
    }else if(strlen($password) < 6) {
    header('location: account.php?error=Password must be at least 6 characters long');

    //noerrors
    }else{

        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss',$password,$user_email);

        if($stmt->execute()){
            header('location: account.php?success=Password changed successfully');
        }else{
            header('location: account.php?error=Failed to change password');
        }

    }
}

//get orders
if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();
}

?>

<?php include('layouts/header.php'); ?>

    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])) { echo $_GET['register_success']; }?></p>
            <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])) { echo $_GET['login_success']; }?></p>
                <h3 class="font-weight-bold">Account Info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name:<span> <?php if (isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?> </span></p>
                    <p>Email:<span> <?php if (isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="" id="orders-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>

</div>
</div>

<div class="col-lg-6 col-md-12 col-sm-12">
    <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color:red"><?php if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
        <p class="text-center" style="color:green"><?php if(isset($_GET['message'])) { echo $_GET['message']; }?></p>
        <h3>Change Password</h3>
        <hr class="mx-auto">
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="account-password" name="password "placeholder="Enter Password" required>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="account-password" name="confirmPassword "placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
        </div>
    </form>
      
</section>



<!--Orders-->
<section class="orders container my-5 py-5">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Order Id</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details</th>
        </tr>

        <?php while($row = $orders->fetch_assoc() ){ ?>



       <tr>
        <td>
            <span><?php echo $row['order_id']; ?> </span>
</td>

<td>
    <span><?php echo $row['order_cost']; ?> </span>
</td>

<td>
    <span><?php echo $row['order_status']; ?> </span>
</td>

<td>
    <span><?php echo $row['order_date']; ?> </span>
</td>

<td>
    <form method="POST" action="order_details.php">
        <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
        <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id"/>
        <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details"/>
    </form>
 </td>

</tr> 

<?php } ?>
   

</table>

</section>



<?php include('layouts/footer.php'); ?>