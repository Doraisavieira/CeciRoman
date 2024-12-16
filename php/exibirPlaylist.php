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

// Consultar playlists do banco de dados
$sql = "SELECT id_playlist, nome_playlist, link_playlist FROM playlist LIMIT 3";
$result = $conn->query($sql);

$playlists = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $playlists[] = $row;
    }
}

while (count($playlists) < 3) {
    $playlists[] = ['id_playlist' => null, 'nome_playlist' => 'Playlist Indisponível', 'link_playlist' => '#'];
}

$conn->close();

return $playlists;
?>
