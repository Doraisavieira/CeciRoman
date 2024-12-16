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

if (!isset($_SESSION['id_usuario'])) {
    echo "<p>Você precisa estar logado para acessar esta página.</p>";
    echo "<a href='login.html'>Ir para o Login</a>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

$sql = "
    SELECT p.nome_playlist, p.link_playlist, h.data_ouvida
    FROM historico_playlists h
    JOIN playlist p ON h.id_playlist = p.id_playlist
    WHERE h.id_usuario = ?
    ORDER BY h.data_ouvida DESC
    LIMIT 3
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$playlists = [];
while ($row = $result->fetch_assoc()) {
    $playlists[] = $row;
}

while (count($playlists) < 4) {
    $playlists[] = ['nome_playlist' => 'Nenhuma playlist ouvida', 'link_playlist' => '#', 'data_ouvida' => null];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman - Últimas Ouvidas</title>
    <link rel="stylesheet" href="../css/tocadasRecs.css">
</head>
<body>
    <header class="header">
        <div class="logo">Ceci Roman <span class="note">♪</span></div>
        <div class="menu-links">
            <a href="../html/playlist.html">Playlists</a>
            <a href="../html/questionario.html">Questionário</a>
            <a href="../html/perfil.html">Meu perfil</a>
            <a href="../html/telaApresentacao.html" class="home-icon">🏠</a>
        </div>
    </header>
    <main class="container">
        <section class="menu">
            <!-- Botão 1: Última Playlist -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[1]['link_playlist']); ?>" target="_blank">
                    <button>Última Ouvida</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[1]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 2: Penúltima Playlist -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[2]['link_playlist']); ?>" target="_blank">
                    <button>Penúltima Ouvida</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[2]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 3: Antepenúltima Playlist -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[3]['link_playlist']); ?>" target="_blank">
                    <button>Antepenúltima Ouvida</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[3]['nome_playlist']); ?></span>
            </div>
        </section>
        <section class="image-container">
            <img src="../img/violaoAzul.png" alt="Violão" class="violao-img">
        </section>
    </main>
</body>
</html>
