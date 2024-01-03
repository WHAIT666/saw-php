<?php
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
    die("ERROR: Unable to connect. " . mysqli_connect_error());
}

$numberOfWrongs = isset($_GET['count']) ? $_GET['count'] : 0;
$userId = 0;
$userEmail = isset($_POST['email']) ? $_POST['email'] : '';

if (!empty($userEmail)) {
    $getId = "SELECT id FROM user WHERE email = '$userEmail'";
    $resultGetId = $conn->query($getId);

    if (mysqli_num_rows($resultGetId) > 0) {
        $row = mysqli_fetch_assoc($resultGetId);
        $userId = $row['id'];
    }
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Sanitize input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $passwordFilter = '/^(?=.*[!@#$%^&*.-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,20}$/';

    if (empty($email) || empty($password)) {
        header("Location: ../pages/login.php?error=Por favor, preencha todos os campos");
        exit();
    } elseif (!preg_match($passwordFilter, $password)) {
        header("Location: ../pages/login.php?error=A senha deve ter pelo menos uma letra maiúscula, um número e um caractere especial");
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepared statements para prevenir sql injection //
        $sql = "SELECT * FROM user WHERE email=? AND password=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['active'] == 1) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email']  = $row['email'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['nTel'] = $row['nTel'];
                $_SESSION['profilePic'] = $row['profilePic'];

                // Handle Remember Me functionality
                if (!empty($_POST['remember_check'])) {
                    $remember_check = $_POST['remember_check'];
                    $key = 'Hipopotamo';
                    $encryptedText = openssl_encrypt($password, 'aes-256-cbc', $key);

                    setcookie('email', $email, time()+(86400*30), "/" );
                    setcookie('password', $encryptedText, time()+(86400*30), "/");
                    setcookie('userLogin', $remember_check, time()+(86400*30), "/");
                } else {
                    setcookie('email', $email, 30);
                    setcookie('password', $hashedPassword,  30);
                }

           // Redirect based on user role
           if ($row['role'] == 'User') {
            echo "Debug Point 6: Redirecting to indexlogged.php"; // Add this line
            header("Location: ../indexlogged.php");
            exit();
        } else {
            echo "Debug Point 7: Redirecting to indexadmin.php"; // Add this line
            header("Location: ../indexadmin.php");
            exit();
        }
    } else {
        echo "Debug Point 8: Redirecting to login.php (Account deactivated)"; // Add this line
        header("Location: ../pages/login.php?error=A conta foi desativada");
        exit();
    }
} else {
    handleLoginAttempts($userId, $numberOfWrongs);
}
}
}

// Function to handle login attempts
function handleLoginAttempts($userId, $numberOfWrongs) {
    $numberOfWrongs++;
    if ($numberOfWrongs >= 3) {
        header("Location: ../pages/login.php?error=Email ou senha incorretos! Mais 2 tentativas antes do bloqueio da conta!&&count=$numberOfWrongs");
        exit();
    } elseif ($numberOfWrongs == 4) {
        blockUserAccount($userId);
    } else {
        header("Location: ../pages/login.php?error=Email ou senha incorretos!&&count=$numberOfWrongs");
        exit();
    }
}

// Function to block user account
function blockUserAccount($userId) {
    global $conn;
    $sql = "UPDATE user SET active = 0 WHERE id = '$userId'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: ../pages/login.php?error=A conta foi bloqueada! Entre em contato com o administrador (andresantosuwu@gmail.com) para recuperar a sua conta.");
        exit();
    } else {
        header("Location: ../pages/login.php?error=Erro ao bloquear a conta");
        exit();
    }
}
?>