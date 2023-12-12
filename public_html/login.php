<?php
// Iniciar a sessão
session_start();

// Configuração da base de dados
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'SAW');

// Conectar à base de dados
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar a conexão
if($conn === false){
    die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}

// Definir e inicializar variáveis
$utilizador = $password = "";
$utilizador_err = $password_err = "";

// Processar dados do formulário quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar se o utilizador está vazio
    if(empty(trim($_POST["utilizador"]))){
        $utilizador_err = 'Por favor, insira o seu utilizador.';
    } else{
        $utilizador = trim($_POST["utilizador"]);
    }

    // Verificar se a password está vazia
    if(empty(trim($_POST['password']))){
        $password_err = 'Por favor, insira a sua password.';
    } else{
        $password = trim($_POST['password']);
    }

    // Validar credenciais
    if(empty($utilizador_err) && empty($password_err)){
        // Preparar uma declaração de seleção
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variáveis à declaração preparada como parâmetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Definir parâmetros
            $param_username = $utilizador;

            // Tentar executar a declaração preparada
            if(mysqli_stmt_execute($stmt)){
                // Armazenar resultado
                mysqli_stmt_store_result($stmt);

                // Verificar se o nome de utilizador existe, se sim, verificar a password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Vincular variáveis de resultado
                    mysqli_stmt_bind_result($stmt, $utilizador, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        // Debugging messages
                        echo "Entered Password: " . $password . "<br>";
                        echo "Hashed Password from Database: " . $hashed_password . "<br>";

                        if(password_verify($password, $hashed_password)){
                            // Password is correct
                            session_start();
                            $_SESSION['username'] = $utilizador;      
                            header("location: welcome.php");
                        } else{
                            // Password is incorrect
                            $password_err = 'A password que inseriu não era válida.';
                        }
                    }
                } else{
                    // Mostrar uma mensagem de erro se o nome de utilizador não existir
                    $utilizador_err = 'Nenhuma conta encontrada com esse nome de utilizador.';
                }
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }

        // Fechar declaração
        mysqli_stmt_close($stmt);
    }

    // Fechar conexão
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid black;
            border-radius: 4px;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            opacity: 0.8;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Utilizador</label>
                <input type="text" name="utilizador" value="<?php echo $utilizador; ?>">
                <span class="error"><?php echo (!empty($utilizador_err)) ? $utilizador_err : ''; ?></span>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo (!empty($password_err)) ? $password_err : ''; ?></span>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
