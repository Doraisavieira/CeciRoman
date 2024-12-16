<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "CeciRoman";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id_usuario = $_SESSION['id_usuario'];

$id_playlist = $_POST['id_playlist'] ?? null;

if ($id_playlist) {
    $sql = "INSERT INTO playlists_favoritadas (id_usuario, id_playlist) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_playlist);

    if ($stmt->execute()) {
        echo "<p>Playlist favoritada com sucesso!</p>";
        echo "<a href='pExatas.php'>Voltar</a>";
    } else {
        echo "<p>Erro ao favoritar a playlist: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID da playlist não fornecido. Tente novamente.</p>";
}

$conn->close();
?>
