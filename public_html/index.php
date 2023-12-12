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
$student_code = $first_name = $last_name = $gender = $phone = $course = $email = $observations = $username = $password = "";
$student_code_err = $first_name_err = $last_name_err = $gender_err = $phone_err = $course_err = $email_err = $observations_err = $username_err = $password_err = "";

// Processar dados do formulário quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar código do estudante
    if (!isset($_POST["student_code"]) || empty(trim($_POST["student_code"]))) {
        $student_code_err = "Por favor, insira o código do estudante.";
    } else {
        $student_code = trim($_POST["student_code"]);
    }

    // Validar primeiro nome
    if (!isset($_POST["first_name"]) || empty(trim($_POST["first_name"]))) {
        $first_name_err = "Por favor, insira o primeiro nome.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validar último nome
    if (!isset($_POST["last_name"]) || empty(trim($_POST["last_name"]))) {
        $last_name_err = "Por favor, insira o último nome.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // Validar género
    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Por favor, selecione um género.";
    } else {
        $gender = trim($_POST["gender"]);
    }

    // Validar curso
    if (empty(trim($_POST["course"]))) {
        $course_err = "Por favor, selecione um curso.";
    } else {
        $course = trim($_POST["course"]);
    }

    // Validar telefone
    if (isset($_POST["phone"])) {
        $phone = trim($_POST["phone"]);
    }

    // Validar email
    if (!isset($_POST["email"]) || empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validar observações
    if (isset($_POST["observations"])) {
        $observations = trim($_POST["observations"]);
    }

    // Validar utilizador
    if (!isset($_POST["username"]) || empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira um utilizador.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validar password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira uma password.";
    } else {
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }

    // Verificar erros de input antes de inserir na base de dados
    if (empty($student_code_err) && empty($first_name_err) && empty($last_name_err) && empty($gender_err) && empty($phone_err) && empty($course_err) && empty($email_err) && empty($observations_err) && empty($username_err) && empty($password_err)) {
        // Preparar uma declaração de inserção
        $sql = "INSERT INTO users (student_code, first_name, last_name, gender, phone, course, email, observations, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Vincular variáveis à declaração preparada como parâmetros
            mysqli_stmt_bind_param($stmt, "isssssssss", $param_student_code, $param_first_name, $param_last_name, $param_gender, $param_phone, $param_course, $param_email, $param_observations, $param_username, $param_password);

            // Definir parâmetros
            $param_student_code = $student_code;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_gender = $gender;
            $param_phone = $phone;
            $param_course = $course;
            $param_email = $email;
            $param_observations = $observations;
            $param_username = $username;
            $param_password = $password;

            // Tentar executar a declaração preparada
            if (mysqli_stmt_execute($stmt)) {
                // Redirecionar para a página de login
                header("location: login.php");
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            mysqli_stmt_close($stmt);
        }
    }

    // Fechar conexão
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registo</title>
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
        input[type="text"], input[type="password"], input[type="number"], input[type="email"] {
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
        <h2>Registo</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Código do Estudante</label>
                <input type="number" name="student_code" value="<?php echo $student_code; ?>">
                <span class="error"><?php echo (!empty($student_code_err)) ? $student_code_err : ''; ?></span>
            </div>
            <div>
                <label>Primeiro Nome</label>
                <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                <span class="error"><?php echo (!empty($first_name_err)) ? $first_name_err : ''; ?></span>
            </div>
            <div>
                <label>Último Nome</label>
                <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                <span class="error"><?php echo (!empty($last_name_err)) ? $last_name_err : ''; ?></span>
            </div>
            <div>
                <label>Género</label>
                <select name="gender">
                    <option value="">Selecione...</option>
                    <option value="M" <?php echo ($gender == 'M') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo ($gender == 'F') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="O" <?php echo ($gender == 'O') ? 'selected' : ''; ?>>Outro</option>
                </select>
                <span class="error"><?php echo (!empty($gender_err)) ? $gender_err : ''; ?></span>
            </div>
            <div>
                <label>Telefone</label>
                <input type="text" name="phone" value="<?php echo $phone; ?>">
                <span class="error"><?php echo (!empty($phone_err)) ? $phone_err : ''; ?></span>
            </div>
            <div>
                <label>Curso</label>
                <select name="course">
                    <option value="">Selecione...</option>
                    <option value="LEI" <?php echo ($course == 'LEI') ? 'selected' : ''; ?>>LEI</option>
                    <option value="SIRC" <?php echo ($course == 'SIRC') ? 'selected' : ''; ?>>SIRC</option>
                    <option value="DWDM" <?php echo ($course == 'DWDM') ? 'selected' : ''; ?>>DWDM</option>
                    <option value="CRSI" <?php echo ($course == 'CRSI') ? 'selected' : ''; ?>>CRSI</option>
                </select>
                <span class="error"><?php echo (!empty($course_err)) ? $course_err : ''; ?></span>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo (!empty($email_err)) ? $email_err : ''; ?></span>
            </div>
            <div>
                <label>Observações</label>
                <textarea name="observations"><?php echo $observations; ?></textarea>
                <span class="error"><?php echo (!empty($observations_err)) ? $observations_err : ''; ?></span>
            </div>
            <div>
                <label>Utilizador</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="error"><?php echo (!empty($username_err)) ? $username_err : ''; ?></span>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo (!empty($password_err)) ? $password_err : ''; ?></span>
            </div>
            <div>
                <input type="submit" value="Registrar">
            </div>
        </form>
    </div>
</body>
</html>
