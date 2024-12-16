<?php
session_start();
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "CeciRoman";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $sql_update = "UPDATE usuarios SET nome = ?, senha = ? WHERE email = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sss", $nome, $senha, $email);

    if ($stmt_update->execute()) {
        echo "<p>Dados atualizados com sucesso!</p>";
        echo "<a href='../html/telaApresentacao.html'>Voltar para a Página Inicial</a>";
    } else {
        echo "<p>Erro ao atualizar os dados: " . $stmt_update->error . "</p>";
    }
    $stmt_update->close();
} else {
    echo "<p>Email não encontrado. Verifique o email informado.</p>";
}

$stmt->close();
$conn->close();
?>
