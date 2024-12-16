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
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE pf.id_usuario = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$favoritas = [];
while ($row = $result->fetch_assoc()) {
    $favoritas[] = $row;
}

while (count($favoritas) < 5) {
    $favoritas[] = ['id_playlist' => null, 'nome_playlist' => 'Indisponível', 'link_playlist' => '#'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman</title>
    <link rel="stylesheet" href="../css/pFavoritas.css">
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
            <!-- Botão 1 -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($favoritas[1]['link_playlist']); ?>" target="_blank">
                    <button><?php echo htmlspecialchars($favoritas[1]['nome_playlist']); ?></button>
                </a>
            </div>

            <!-- Botão 2 -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($favoritas[2]['link_playlist']); ?>" target="_blank">
                    <button><?php echo htmlspecialchars($favoritas[2]['nome_playlist']); ?></button>
                </a>
            </div>

            <!-- Botão 3 -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($favoritas[3]['link_playlist']); ?>" target="_blank">
                    <button><?php echo htmlspecialchars($favoritas[3]['nome_playlist']); ?></button>
                </a>
            </div>

            <!-- Botão 4 -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($favoritas[4]['link_playlist']); ?>" target="_blank">
                    <button><?php echo htmlspecialchars($favoritas[4]['nome_playlist']); ?></button>
                </a>
            </div>

            <!-- Botão 5 -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($favoritas[5]['link_playlist']); ?>" target="_blank">
                    <button><?php echo htmlspecialchars($favoritas[5]['nome_playlist']); ?></button>
                </a>
            </div>
        </section>
        <section class="image-container">
            <img src="../img/violaoAzul.png" alt="Violão" class="violao-img">
        </section>
    </main>
</body>
</html>
