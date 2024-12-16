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

// Consulta para obter as playlists mais favoritadas de cada componente curricular
$sql = "
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist, COUNT(pf.id_favorito) AS total_favoritos
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE p.nome_playlist LIKE '%Exatas%'
    GROUP BY p.id_playlist
    ORDER BY total_favoritos DESC
    LIMIT 1
    UNION ALL
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist, COUNT(pf.id_favorito) AS total_favoritos
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE p.nome_playlist LIKE '%Humanas%'
    GROUP BY p.id_playlist
    ORDER BY total_favoritos DESC
    LIMIT 1
    UNION ALL
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist, COUNT(pf.id_favorito) AS total_favoritos
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE p.nome_playlist LIKE '%Redação%'
    GROUP BY p.id_playlist
    ORDER BY total_favoritos DESC
    LIMIT 1
    UNION ALL
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist, COUNT(pf.id_favorito) AS total_favoritos
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE p.nome_playlist LIKE '%Linguagens%'
    GROUP BY p.id_playlist
    ORDER BY total_favoritos DESC
    LIMIT 1
    UNION ALL
    SELECT p.id_playlist, p.nome_playlist, p.link_playlist, COUNT(pf.id_favorito) AS total_favoritos
    FROM playlists_favoritadas pf
    JOIN playlist p ON pf.id_playlist = p.id_playlist
    WHERE p.nome_playlist LIKE '%Natureza%'
    GROUP BY p.id_playlist
    ORDER BY total_favoritos DESC
    LIMIT 1
";
$result = $conn->query($sql);

$playlists = [];
while ($row = $result->fetch_assoc()) {
    $playlists[] = $row;
}

while (count($playlists) < 6) {
    $playlists[] = ['id_playlist' => null, 'nome_playlist' => 'Indisponível', 'link_playlist' => '#', 'total_favoritos' => 0];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman - Favoritas da Galera</title>
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
            <!-- Botão 1: Exatas -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[1]['link_playlist']); ?>" target="_blank">
                    <button>Favorita da galera (Exatas)</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[1]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 2: Humanas -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[2]['link_playlist']); ?>" target="_blank">
                    <button>Favorita da galera (Humanas)</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[2]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 3: Redação -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[3]['link_playlist']); ?>" target="_blank">
                    <button>Favorita da galera (Redação)</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[3]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 4: Linguagens -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[4]['link_playlist']); ?>" target="_blank">
                    <button>Favorita da galera (Linguagens)</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[4]['nome_playlist']); ?></span>
            </div>

            <!-- Botão 5: Natureza -->
            <div class="playlist-button">
                <a href="<?php echo htmlspecialchars($playlists[5]['link_playlist']); ?>" target="_blank">
                    <button>Favorita da galera (Natureza)</button>
                </a>
                <span><?php echo htmlspecialchars($playlists[5]['nome_playlist']); ?></span>
            </div>
        </section>
        <section class="image-container">
            <img src="../img/violaoAzul.png" alt="Violão" class="violao-img">
        </section>
    </main>
</body>
</html>
