<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "CeciRoman";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($senhaHash);
        $stmt->fetch();

        if (password_verify($senha, $senhaHash)) {

            header("Location: ../html/telaApresentacao.html");
            session_start();
            exit();
        } else {
        
            echo "Senha incorreta. <a href='../html/telaLogin.html'>Tente novamente</a>.";
        }
    } else {

        echo "Email não encontrado. <a href='../html/telaLogin.html'>Tente novamente</a>.";
    }

    $stmt->close();
}

$conn->close();
?>
