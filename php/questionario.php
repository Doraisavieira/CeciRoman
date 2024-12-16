<?php
session_strat();
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "CeciRoman";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$respostas = [
    $_POST['q1'] ?? '',
    $_POST['q2'] ?? '',
    $_POST['q3'] ?? '',
    $_POST['q4'] ?? '',
    $_POST['q5'] ?? '',
    $_POST['q6'] ?? '',
    $_POST['q7'] ?? '',
    $_POST['q8'] ?? ''
];

$contagem = array_count_values($respostas);

$maioria = array_keys($contagem, max($contagem))[0];
switch ($maioria) {
    case 'a':
        $genero = "Música eletrônica, pop ou funk";
        break;
    case 'b':
        $genero = "MPB, folk ou acústico suave";
        break;
    case 'c':
        $genero = "Sertanejo, indie ou música romântica";
        break;
    case 'd':
        $genero = "Rock, metal ou punk";
        break;
    case 'e':
        $genero = "Sertanejo (universitário ou tradicional) e outros populares";
        break;
    default:
        $genero = "Não identificado";
        break;
}

$id_usuario = ?; 
$sql = "UPDATE usuarios SET genero_musical = ? WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $genero, $id_usuario);

if ($stmt->execute()) {
    echo "<p>Gênero musical atualizado com sucesso: $genero</p>";
    echo "<a href='../html/telaApresentacao.html'>Voltar para a Página Inicial</a>";
} else {
    echo "<p>Erro ao atualizar o gênero musical: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>
