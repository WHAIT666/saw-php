<?php
// Start the session
session_start();

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

// Prepare a select statement
$sql = "SELECT student_code, first_name, last_name, gender, phone, course, email, observations, username FROM users WHERE username = ?";

if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    // Set parameters
    $param_username = $_SESSION['username'];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if the username exists, if yes then fetch the data
        if(mysqli_stmt_num_rows($stmt) == 1){                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $student_code, $first_name, $last_name, $gender, $phone, $course, $email, $observations, $username);
            if(mysqli_stmt_fetch($stmt)){
                // User data fetched successfully, display it in a table
            }
        }
    }
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            background-color: #ADD8E6;
            font-family: Arial, sans-serif;
            color: #191970;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .admin-feature {
            background-color: #F0F8FF;
            margin: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        a {
            color: #191970;
            text-decoration: none;
            font-size: 18px;
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid #191970;
            border-radius: 5px;
            transition: background-color 0.5s ease;
        }
        a:hover {
            background-color: #191970;
            color: #F0F8FF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #191970;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #191970;
            color: #F0F8FF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Olá, <?php echo $_SESSION['username']; ?>!</h1>
        <div class="admin-feature">
            <h2>Administrator Features</h2>
            <a href="manage_users.php">Manage Users</a><br>
            <a href="view_statistics.php">View Site Statistics</a>
        </div>
        <table>
            <tr>
                <th>Student Code</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Email</th>
                <th>Observations</th>
                <th>Username</th>
            </tr>
            <tr>
                <td><?php echo $student_code; ?></td>
                <td><?php echo $first_name; ?></td>
                <td><?php echo $last_name; ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $course; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $observations; ?></td>
                <td><?php echo $username; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
