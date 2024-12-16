<?php
session_start();

$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "CeciRoman";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $token = bin2hex(random_bytes(32));
        $validade = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $stmt = $conn->prepare("UPDATE usuarios SET token_recuperacao = ?, validade_token = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $validade, $email);
        $stmt->execute();

        $link = "http://seusite.com/redefinirSenha.php?token=$token";

        $assunto = "Recuperação de Senha - Ceci Roman";
        $mensagem = "Olá, clique no link abaixo para redefinir sua senha:\n\n$link\n\nEste link é válido por 1 hora.";
        $headers = "From: no-reply@seusite.com";

        if (mail($email, $assunto, $mensagem, $headers)) {
            echo "Um email foi enviado para $email com instruções para redefinir sua senha.";
        } else {
            echo "Erro ao enviar o email. Tente novamente mais tarde.";
        }
    } else {
        echo "Email não encontrado. <a href='recuperaSenha.php'>Tente novamente</a>.";
    }

    $stmt->close();
}

$conn->close();
?>
