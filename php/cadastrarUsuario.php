<?php
session_start();
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "CeciRoman";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);
    $confirmarSenha = trim($_POST["confirmar_senha"]);

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        die("Por favor, preencha todos os campos.");
    }

    if ($senha !== $confirmarSenha) {
        die("As senhas não correspondem.");
    }

    if (
        strlen($senha) < 6 ||
        !preg_match('/[A-Z]/', $senha) ||
        !preg_match('/[a-z]/', $senha) ||
        !preg_match('/[0-9]/', $senha) ||
        !preg_match('/[\W]/', $senha)
    ) {
        die("A senha não atende aos requisitos de segurança.");
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    if ($stmt->execute()) {
        $_SESSION['usuario_id'] = $conn->insert_id;
        header("Location: ../html/telaApresentacao.html");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
