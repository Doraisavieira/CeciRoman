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
    $token = $_POST["token"];
    $novaSenha = password_hash($_POST["nova_senha"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE token_recuperacao = ? AND validade_token >= NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ?, token_recuperacao = NULL, validade_token = NULL WHERE token_recuperacao = ?");
        $stmt->bind_param("ss", $novaSenha, $token);
        $stmt->execute();

        echo "Senha redefinida com sucesso! <a href='telaLogin.html'>Ir para o login</a>";
    } else {
        echo "Token inválido ou expirado. Solicite uma nova recuperação. <a href='recuperaSenha.php'>Tente novamente</a>.";
    }

    $stmt->close();
} elseif (isset($_GET["token"])) {
    $token = $_GET["token"];
} else {
    echo "Token não fornecido. <a href='recuperaSenha.php'>Tente novamente</a>.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha - Ceci Roman</title>
    <link rel="stylesheet" href="../css/esqueceuSenha.css">
</head>
<body>
    <div class="container">
        <h1>Redefinir Senha</h1>
        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="form-group">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha" class="input-field" required>
            </div>
            <button type="submit" class="button">Redefinir</button>
        </form>
    </div>
</body>
</html>
